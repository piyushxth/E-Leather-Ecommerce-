<?php

namespace App\Http\Controllers\Customer;

use Cixware\Esewa\Client, Cixware\Esewa\Config;
use App\Http\Controllers\Controller;
use App\Models\Districts;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\OrderItems;
use App\Models\User;
use App\Models\Provinces;
use App\Models\ProductSizes;
use App\Notifications\StatusNotification,
    App\Notifications\SendEmail;
use Auth, Str, Notification, Cart, Session, Mail;

class CheckoutController extends Controller
{
    private $esewa_success_url,
        $esewa_failure_url,
        $esewa_merchant_id;

    public function __construct()
    {
        $this->middleware(["XssSanitizer"]);
        $this->esewa_success_url = url("/") . "/pay/esewa-success";
        $this->esewa_failure_url = url("/") . "/pay/esewa-fail";
        $this->esewa_merchant_id = env("ESEWA_MERCHANT_CODE", "ES-ELN");
    }
    public function index()
    {
        $title = "Checkout";
        $shipping = Shipping::get();
        $provinces = Provinces::orderBy("id", "ASC")->get();
        $province_id =
            Auth::user()->provience != null ? Auth::user()->provience : "";
        return view(
            "frontend/pages/checkout",
            compact("title", "shipping", "provinces", "province_id")
        );
    }

    public function store(Request $request)
    {
        // dd($request);
        $userdata = User::find(Auth::user()->id);
        $users = User::where("role", "admin")->first();

        $this->validate(

            $request,
            [
                "name" => "regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|required",
                "number" => "required|digits:10",
                "email" => "required|regex:/(.+)@(.+)\.(.+)/i",
                "provience" => "required",
                "district" => "required",
                "street" => "required",
                "payment_method" => "required",
            ],
            [
                "name.required" => "Name is required",
                "name.regex" => "Name must be String",
                "number.required" => "Contact number is required",
                "number.digits" => "Contact number must be minimum 10 number",
                "email.required" => "Email is required",
                "email.regex" => "Invalid email format",
                "provience.required" => "Provience is required",
                "district.required" => "District  is required",
                "street.required" => "Street is required",
                "payment_method.required" => "Payment Method is required",
            ]
        );

        $input = $request->all();
        $input["name"] = $request->input("street");
        $input["price"] = $request->input("sub_total");
        $shipping = Shipping::create($input);
        $shippingId = Shipping::latest()->first();
        $inputOrder = $request->all();
        $inputOrder["order_number"] = "ORD-" . strtoupper(Str::random(10));
        $inputOrder["user_id"] = Auth::user()->id;
        $inputOrder["sub_total"] = $request->sub_total;
        $inputOrder["shipping_id"] = $shippingId->id;
        $inputOrder["total_amount"] = $request->input("sub_total");
        $inputOrder["phone"] = $request->input("number");
        $inputOrder["full_name"] = $request->input("name");
        $inputOrder["address"] = $request->input("street");

        try {
            $provienceShipping = Provinces::where('id', $request->input("provience"))->get("province_name");
            $districtShipping = Districts::where('id', $request->input("district"))->get("district_name");
            $provienceBilling = Provinces::where('id', Auth()->User()->provience)->get("province_name");
            $districtBilling = Districts::where('id', Auth()->User()->district)->get("district_name");
            $order = Order::create($inputOrder);
            $orderId = Order::latest()->first();
            $request->request->add(['order_id' => $orderId->id]);
            $date = date($orderId->created_at);

            //Insert into OrderItems Table
            foreach (Cart::instance(auth()->user()->id)->content() as $item) {
                $orderitems = OrderItems::create([
                    "order_id" => $orderId->id,
                    "product_id" => $item->model->id,
                    "quantity" => $item->qty,
                    "size" => $item->options[0],
                    "price" => $item->price,
                    "product_attr_image" => $item->options[1],
                ]);
            }

            $notification_details = [
                "title" => "New order created",
                "actionURL" => route("admin.order.show", $orderId->id),
                "fas" => "fa-file-alt",
            ];

            $email_details = [
                "first_name" => $request->input("name"),
                "email" => $request->input("email"),
                "phone" => $request->input("number"),
                "order_number" => $inputOrder["order_number"],
                "total_amount" => $inputOrder["total_amount"],
                "location" => $request->input("street"),
                "number" => $request->input("number"),
                "shipping_charge" => "0",
                "date" => $date,
                "provienceShipping" => $provienceShipping[0]['province_name'],
                "districtShipping" => $districtShipping[0]['district_name'],
                "provienceBilling" => $provienceBilling[0]['province_name'],
                "districtBilling" => $districtBilling[0]['district_name'],
            ];

            Notification::send($users, new StatusNotification($notification_details));
            Mail::to(Auth::user()->email)->send(
                new \App\Mail\OrderMailable($email_details)
            );

            //Remove Stock and Cart
            if ($orderitems) {
                foreach (Cart::instance(auth()->user()->id)->content() as $item) {
                    $remove_size = ProductSizes::where([
                        "product_id" => $item->model->id,
                        "size" => $item->options[0],
                    ])->firstOrFail();
                    $remove_size->stock = $remove_size->stock - $item->qty;
                    $remove_size->save();
                }
                Cart::destroy();
            }
            if ($inputOrder['payment_method'] == 'esewa') {
                $this->payProcess($request);
            } else {
                return redirect()
                    ->route("customer.checkout.finish")
                    ->with("success_msg", "Order placed successfully");
            }
        } catch (\Exception $e) {
            return redirect()
                ->route("customer.checkout.finish")
                ->with("error_msg", "Order cannot be placed. Please try again");
        }
    }

    public function finish(Request $request)
    {
        $title = "Finish | Checkout";
        return view(
            "frontend/pages/checkout_complete",
            compact("title")
        );
    }

    public function payProcess(Request $request)
    {

        if (\App::environment(["local", "staging", "dev", "development"])) {
            $config = new Config(
                $this->esewa_success_url,
                $this->esewa_failure_url
            );
        } else {
            $config = new Config(
                $this->esewa_success_url,
                $this->esewa_failure_url,
                $this->esewa_merchant_id
            );
        }
        $response = $this->_processEsewa($config,  $request);
    }

    public function _processEsewa($gateway_configuration, $request)
    {
        $total_amount = (int) $request->sub_total;
        $o_id = $request->order_id;

        // Initialize eSewa client
        $esewa = new Client($gateway_configuration);

        // Process the payment
        $esewa->process($o_id, $total_amount, 0, 0, 0);

        // Dump all request data for debugging
        // dd($request->all());
    }


    public function esewasuccess(Request $request)
    {
        $order_id = $request->input("oid");
        $amount = $request->input("amt");
        $refid = $request->input("refId");
      
        $payment_gateway = Str::ucfirst("esewa");
        $title = "Payment Success";
        $order_details = Order::where([
            "id" => $order_id,
            "payment_method" => "esewa",
        ])->first();
        if ($order_details->payment_status == "unpaid") {
            $order_details->payment_status = "paid";
            $order_details->updated_at = now()->format("Y-m-d H:i:s");
            $order_details->update();
            return view(
                "frontend.pages.paymentsuccess",
                compact(
                    "title"
                )
            );
        } 
    }

    public function esewafail(Request $request)
    {
        $title = "Payment Failed";
        return view(
            "frontend.pages.paymentfail",
            compact(
                "title"
            )
        );
    }
}
