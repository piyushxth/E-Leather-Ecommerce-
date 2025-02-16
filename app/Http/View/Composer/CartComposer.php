<?php

namespace App\Http\View\Composer;

use Illuminate\View\View;
use Auth, Cart;

class CartComposer
{
    public function compose(View $view)
    {
        $cart_count = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;

            // $cart_count = Cart::content()->count();
            $cart_count=Cart::instance("".$user_id)->content()->count();

        }
        $view->with("cart_count", $cart_count);
    }
}
