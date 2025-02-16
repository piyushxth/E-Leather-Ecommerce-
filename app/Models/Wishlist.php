<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $table='wishlists';
    protected $fillable=[
        'user_id',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    
    public function product_attr()
    {
        return $this->hasMany('App\Models\ProductAttribute','product_id','product_id');
    }
}
