<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Order;

class TrackOrderController extends Controller
{
    //
    public function track_order(Request $request)
    {
        
           $user=Auth::user()->id;
           $order=Order::select('status')->where(['order_number'=>$request->track_order,'user_id'=>$user])->firstorFail();
           return view('frontend.pages.track_order',compact('order'));

    }
}
