<?php

namespace App\Model\Buyer;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{

    protected $table = "buyers";

    public static $titles = [
        0=>'Mr',
        1=>'Mrs',
        2=>'Miss',
        3=>'Dr',
        4=>'Prof'
    ];
    protected $fillable = ['approved', 'experian_rating', 'company_website', 'job_title'];

    public function user() {

        return $this->belongsTo('App\Model\Users\User');

    }

    /**
     * @return string the title
     */
    public function getTheTitleAttribute(){
        if($this->title)
            return isset(self::$titles[$this->title])?self::$titles[$this->title]:$this->title;
        else
            return $this->title;
    }




}
