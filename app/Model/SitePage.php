<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SitePage extends Model
{
    //
    protected $table = "site_pages";



    public static function saving($query)
    {
        $query->slug = str_slug($query->title);
    }

    public static function updating($query)
    {
        $query->slug = str_slug($query->title);
    }

}
