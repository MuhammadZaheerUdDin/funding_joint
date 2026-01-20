<?php

namespace App\Model\Bank;

use Illuminate\Database\Eloquent\Model;

class BankStatement extends Model
{
    //
    protected $table = 'bank_statements';

    protected $fillable = ['bank_id','statement_name'];

    public function user() {

        return $this->belongsTo('App\Model\Users\User');
    }
}
