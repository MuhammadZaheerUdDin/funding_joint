<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = "comments";

    public function user()
    {

        return $this->hasOne('App\Model\Users\Seller','user_id','commenter_id');
    }
    public function seller()
    {

        return $this->hasOne('App\Model\Users\Seller','user_id','child_id');
    }
}
