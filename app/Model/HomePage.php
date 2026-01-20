<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    //
    protected $table = "homepage_section";


    /**
     * @param \Closure|string $query
     */
    public static function saving($query)
    {
        $query->slug = str_slug($query->title);
    }

    /**
     * @param \Closure|string $query
     */
    public static function updating($query)
    {
        $query->slug = str_slug($query->title);
    }

}
