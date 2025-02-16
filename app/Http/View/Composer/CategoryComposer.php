<?php

namespace App\Http\View\Composer;

use Illuminate\View\View;
use App\Models\Category;

class CategoryComposer
{
    public function compose(View $view)
    {
        $categories = Category::whereNull("parent_id")
            ->where("status", "1")
            ->orderBy("order", "ASC")
            ->get();
        $suitable_for_groups = suitable_for_groups();

        $view
            ->with("categories", $categories)
            ->with("suitable_for_groups", $suitable_for_groups);
    }
}