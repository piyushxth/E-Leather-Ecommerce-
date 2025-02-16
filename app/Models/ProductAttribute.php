<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $table = 'product_attributes';

    protected $fillable = [
        'product_id',
        'color_code',
        'color_name',
        'size',
        'sku',
        'price',
        'product_variation_image',
        'stock',
        'status',

    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
