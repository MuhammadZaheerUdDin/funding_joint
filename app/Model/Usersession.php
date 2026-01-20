<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Usersession extends Model
{
    //
    protected $table = "user_session";

    protected $fillable = [
        'session_id'
    ];


    public static function saving($query)
    {
        $query->slug = str_slug($query->title);
    }

    public static function updating($query)
    {
        $query->slug = str_slug($query->title);
    }

}
