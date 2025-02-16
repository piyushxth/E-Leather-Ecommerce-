<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table='orders';
    protected $fillable=[
        'user_id',
        'full_name',
        'phone',
        'email',
        'address',
        'order_notes',
        'sub_total',
        'order_number',
        'total_amount',
        'shipping_id',
        'payment_method',
        'payment_status',
        'status',
    ];

    public function shipping()
    {
        return $this->belongsTo('App\Models\Shipping');
    }
    public function orderitems()
    {
        return $this->hasMany('App\Models\OrderItems', "order_items_order_id","orders_id");
    }
}
