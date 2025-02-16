<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review, App\Models\User, App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $review = Review::count();
        $user = User::count();
        $order = Order::where("status", "new")->count();
        $sales = Order::where("status", "delivered")->count();
        $title = "Dashboard";
        return view(
            "backend.dashboard",
            compact("review", "user", "order", "sales", "title")
        );
    }
}
