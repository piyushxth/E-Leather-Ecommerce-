<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\OrderItems;
use App\Models\Order;
use App\Models\User;
use App\Notifications\SendEmail;
use App\Notifications\OrderStatusEmail;
use Str,Cart,Notification;

class OrderController extends Controller
{
    public function index()
    {
        $title = "Order";
        $orders = Order::orderByRaw(
            "FIELD(status, 'new', 'process', 'delivered', 'cancel', 'cancelled')"
        )
            ->orderBy("created_at")
            ->with("shipping")
            ->get();
        return view("backend.pages.order.index", compact("orders","title"));
    }


    public function show(Order $order)
    {
        $title = "View Order";
        return view("backend.pages.order.show", compact("order","title"));
    }


    public function edit(Order $order)
    {
        $title = "Edit Order";
        return view("backend.pages.order.edit", compact("order","title"));
    }


    public function update(Request $request, Order $order)
    {
        $this->validate($request, [
            "status" => "required|in:new,process,shipping,delivered,cancel",
        ],[
            "status.required" => "Status is required",
            "status.in" => "Selected status is invalid"
        ]);
        $data = $request->all();
        $status = $order->fill($data)->save();

        if ($status) {
            $user = User::where("id", $order->user_id)->first();
            $details = [
                "status" => $request->status,
            ];
            $user->notify(new OrderStatusEmail($user, $details));
        }

        if ($status) {
            request()
                ->session()
                ->flash("success", "Successfully updated order");
        } else {
            request()
                ->session()
                ->flash("error", "Error while updating order");
        }
        return redirect()->route("admin.order.index");
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route("admin.order.index");
    }

    public function orderitem($id)
    {
        $title = "Order";
        $orderitem = OrderItems::where("order_id", $id)
            ->with("products")
            ->get();
        return view("backend.pages.order.order_item", compact("orderitem","title"));
    }
}
