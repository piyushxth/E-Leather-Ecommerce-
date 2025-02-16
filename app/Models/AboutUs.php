<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;
    protected $table = "about_us";

    protected $fillable = [
        "about_us_description",
        "about_us_image",
        "about_us_metatitle",
        "about_us_metakeyword",
        "about_us_metadescription",
        "about_us_schema"
    ];
}
