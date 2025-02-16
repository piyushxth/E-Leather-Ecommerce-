<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Auth;
class NotificationController extends Controller
{
    public function index()
    {
        $title = "Notification";
        return view('backend.pages.notification.index', compact("title"));
    }

    public function show($id)
    {
        $notification=Auth()->user()->notifications()->where('id',$id)->first();
        if($notification){
            $notification->markAsRead();
            return redirect($notification->data['actionURL']);
        }
    }

    public function destroy($id)
    {
        $notification=Notification::find($id);
        if($notification){
            $status=$notification->delete();
            if($status){
                request()->session()->flash('success_msg','Notification successfully deleted');
                return back();
            }
            else{
                request()->session()->flash('error_msg','Error please try again');
                return back();
            }
        }
        else{
            request()->session()->flash('error_msg','Notification not found');
            return back();
        }
    }
}
