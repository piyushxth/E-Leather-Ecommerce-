<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homepageextra extends Model
{
    use HasFactory;

    protected $table = "homepageextras";

    protected $fillable = [
        "homepageextra_bannerimage",
        "homepageextra_bannerlink",
        "homepageextra_shortdescription",
        "homepageextra_shortdescriptionimg",
        "homepageextra_shortdescriptionlink",
        "homepageextra_mentileimg",
        "homepageextra_mentilelink",
        "homepageextra_womentileimg",
        "homepageextra_womentilelink",
        "homepageextra_kidtileimg",
        "homepageextra_kidtilelink"
    ];
}

