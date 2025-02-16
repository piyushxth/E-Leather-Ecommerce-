<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItems;
use Auth;

class OrderController extends Controller
{
    private $index_view;
    private $orderview;
    private $user_id;

    public function __construct()
    {
        $this->middleware(["XssSanitizer"]);
        $this->index_view = "frontend.customer.order";
        $this->orderview = "frontend.customer.orderview";
        $this->middleware(function ($request, $next) {
            $this->user_id = Auth::user()->id;
            return $next($request);
        });
    }

    public function index()
    {
        $orders = Order::where("user_id", $this->user_id)
            ->latest()
            ->paginate(12);
        $title = "Orders";
        return view($this->index_view, compact("title", "orders"));
    }

    public function show($id)
    {
        $title = "Orders";
        $order = Order::with("orderitems", "shipping")
            ->where("id", $id)
            ->firstOrfail();
        $orderitem = OrderItems::where("order_id", $id)
            ->with("products")
            ->get();
        return view($this->orderview, compact("order", "orderitem", "title"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "status" => "required|string",
        ]);
        $status = $request->status;
        if ($status != "cancel") {
            return redirect()
                ->back()
                ->with("error_msg", "You can only cancel order");
        }
        $order = Order::with("orderitems")
            ->where("id", $id)
            ->firstOrFail();
        // cancel order
        $order->status = $status;
        $order->save();
        return redirect()
            ->route("customer.order.index")
            ->with("success_msg", "Cancelled Successfully!");
    }
    public function order_items($id)
    {
        $orderDetails = OrderItems::where("order_id", $id)
            ->join("products", "order_items.product_id", "=", "products.id")
            ->get();
        return response()->json([
            "viewOrderDetails" => view(
                "frontend.customer.order_items",
                compact("orderDetails")
            )->render(),
        ]);
    }
}