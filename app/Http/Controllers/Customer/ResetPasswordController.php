<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Hash;

class ResetPasswordController extends Controller
{

    protected $index_view='frontend.customer.auth.reset';
    public function show_password_reset_form()
    {
        return view($this->index_view);
    }
    
    public function reset_password(Request $request)
    {
        $request->validate([
            'current_psw' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
        // dd($request->all());
        $current_user_password = Auth::User()->password;
        if( $request->current_psw == $request->password)
        {
            return redirect()->back()->with('error_msg', 'Current Password and New Password cannot be same!');
        }
        if (Hash::check($request->current_psw, $current_user_password)) {
            $user_id = Auth::User()->id;
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($request->password);
            $obj_user->save();
            return redirect()->back()->with('success_msg', 'Password Changed.');
        } else {
            return redirect()->back()->with('error_msg', 'Invalid Current Password');
        }
    }

}
