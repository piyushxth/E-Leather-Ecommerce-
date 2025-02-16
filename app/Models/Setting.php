<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table="settings";
    protected $fillable=[
        "email",
        "phone_number",
        "mobile_number",
        "address",
        "facebook_link",
        "instagram_link",
        "youtube_link",
        "tiktok_link",
        "google_map",
        "metatitle",
        "metakeyword",
        "metadescription",
        "schema"
    ];
}
