<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Pages extends Model
{
    use HasFactory;

    use Sluggable;

    protected $table = "pages";

    protected $fillable = [
        "page_title",
        "page_slug",
        "page_description",
        "page_image",
        "page_metatitle",
        "page_metakeyword",
        "page_metadescription",
        "page_schema"
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            "page_slug" => [
                "source" => "page_title",
                "onUpdate" => false,
            ]
        ];
    }
}
