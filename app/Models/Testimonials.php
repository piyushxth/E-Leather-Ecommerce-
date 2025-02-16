<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonials extends Model
{
    use HasFactory;
    protected $table = "testimonials";
    protected $fillable = [
        "testimonial_author",
        "testimonial_designation",
        "testimonial_description",
        "testimonial_image",
        "testimonial_order"
    ];
}
