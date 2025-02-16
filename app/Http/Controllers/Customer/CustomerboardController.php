<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Wishlist;
use App\Models\User;
use App\Models\Provinces;
use App\Models\Districts;
use App\Models\Review;
use Auth, Session;

class CustomerboardController extends Controller
{
    private $user_id;

    public function __construct(){
        $this->middleware(["XssSanitizer"]);
    }

    public function index()
    {
        $this->user_id = \Auth::user()->id;
        $title = "Dashboard";
        $no_of_orders = Order::where("user_id", $this->user_id)->count();
        $no_of_items_in_wishlist = Wishlist::where(
            "user_id",
            $this->user_id
        )->count();

        $orders = Order::where("user_id", $this->user_id)
            ->latest()
            ->paginate(15);

        return view(
            "frontend.customer.dashboard",
            compact("orders", "no_of_orders", "no_of_items_in_wishlist","title")
        );
    }

    public function account_detail()
    {
        $title = "Account Information";
        $provinces = Provinces::orderBy("id", "ASC")->get();
        $province_id = (Auth::user()->provience != NULL) ? Auth::user()->provience :  "";
        return view(
            "frontend.customer.account_detail",
            compact("title", "provinces","province_id")
        );
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                "name" => "required",
                "email" =>
                    "required|email|unique:users,email," . $request->id,
                "phone" => "required|numeric|digits:10",
                "address" => "required",
                "provience" => "required",
                "district" => "required",
            ],
            [
                "name.required" => "Name is required",
                "email.required" => "Email is required",
                "email.email" => "Email must be valid email",
                "email.unique" => "Email $request->email already in use. Please try with another one",
                "phone.required" => "Phone is required",
                "phone.numeric" => "Phone number must be numeric",
                "phone.digits" => "The phone must be 10 digits.",
                "address.required" => "Address is required",
                "provience.required" => "Provience is required",
                "district.required" => "District is required",
            ]
        );

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->provience = $request->provience;
        $user->district = $request->district;
        $user->save();
        return redirect('customer/cart')
            // ->back()
            ->with("success_msg", "Account Information saved successfully");
    }

    public function logout()
    {
        Session::forget("user");
        Auth::logout();
        request()
            ->session()
            ->flash("success_msg", "Logout successfully");
        return redirect("/");
    }

    public function reviews()
    {
        $title = "Reviews";
        $reviews = Review::all();
        return view(
            "frontend.customer.reviews",
            compact("title", "reviews")
        );
    }

    public function getDistricts(Request $request)
    {
        $province_id = $request->state_id;
        $district_id = (Auth::user()->district != NULL) ? Auth::user()->district :  "";
        $districts = Districts::where(["province_id" => $province_id])
            ->orderBy("district_name", "ASC")
            ->get();
        $html = view("frontend.customer.options_list", compact("districts","district_id"))->render();
        return response()->json([
            "district_options" => $html,
        ]);
    }
}
