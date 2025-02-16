<?php

namespace App\Http\View\Composer;

use Illuminate\View\View;
use App\Models\Navbar, App\Models\Category;

class NavbarComposer
{
    public function compose(View $view)
    {
        $navbars = Navbar::whereNull('parent_id')
            ->with('navbars')
            ->with('childrenNavbars')
            ->where('status', '1')
            ->asc()
            ->get();
        $view->with('navbars_com', $navbars);
    }
}