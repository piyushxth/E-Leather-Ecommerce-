<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;


    protected $table = 'categories';

    protected $fillable = [
        'category_name',
        'slug',
        'status',
        'category_image',
        'featured_category',
        'order',
        'seo_title',
        'seo_description',
        'seo_keyword',
        'schema',
        'parent_id'
    ];


    // First Children
    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->orderBy('order');
    }

    //  All Children
    public function childrenCategories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->with('categories');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'category_id');
    }


    public function childrenCategoriesIds(&$arr)
    {
        $categories = $this->categories()->get();
        foreach ($categories as $child) {
            if (count($child->categories) > 0) {
                $child->childrenCategoriesIds($arr);
            } else {
                array_push($arr, $child->id);
            }
        }
    }

    public function product()
    {
        return $this->belongsToMany(
            Product::class,
            'product_categories',
            'category_id',
            'product_id');
    }



}
