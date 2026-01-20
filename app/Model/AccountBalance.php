<?php

namespace App\Model;

use App\Model\Bank\BankDetails;
use Illuminate\Database\Eloquent\Model;

class AccountBalance extends Model
{
    protected $table = 'account_balance';
    protected $fillable = ['balance'];

    public function transactions(){
        return Transaction::where('user_id',$this->user_id)->get();
    }

    public function bankDetails(){
        return BankDetails::where('user_id',$this->user_id)->get();
    }

    public function getFormattedBalanceAttribute()
    {
        return money_format('£%i', $this->balance);
    }
}
