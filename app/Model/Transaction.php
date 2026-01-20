<?php

namespace App\Model;

use App\Model\Users\Investor;
use App\Model\Users\Seller;
use App\Model\Users\User;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $table = "transactions";
    const CREDIT = 'credit';
    const DEBIT = 'debit';
    const COMPLETE = 'Completed';
    const NOT_COMPLETE = 'Not Completed';


    protected $fillable = ['user_id', 'amount', 'description', 'new_balance','auction_id','remarks' ,'confirmed', 'reference', 'type', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function seller()
    {
        return $this->belongsTo(Seller::class, 'user_id', 'user_id');
    }

    public function investor()
    {
        return $this->belongsTo(Investor::class, 'user_id', 'user_id');
    }

    public function scopeConfirmed($query)
    {

        return $query->where('confirmed', 1);

    }
}
