<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;
    protected $table="order_items";
    protected $fillable=[
        'order_id',
        'product_id',
        'quantity',
        'size',
        'price',
        'product_attr_image',
    ];

    public function products()
    {
        return $this->belongsTo('App\Models\Product','product_id');
    }
}
