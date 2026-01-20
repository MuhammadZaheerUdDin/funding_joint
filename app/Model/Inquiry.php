<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    //
    protected $table = "inquiry";



    public static function saving($query)
    {
        $query->slug = str_slug($query->title);
    }

    public static function updating($query)
    {
        $query->slug = str_slug($query->title);
    }

}
