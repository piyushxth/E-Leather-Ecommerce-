<?php

namespace App\Http\View\Composer;

use Illuminate\View\View;
use App\Models\Wishlist;
use Auth,Cart;

class WishlistComposer
{
    public function compose(View $view)
    {
        $wishlist_count = 0;
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $wishlist_count = Cart::instance("wishlist_".$user_id)->content()->count();
        }
        $view->with("wishlist_count", $wishlist_count);
    }
}
