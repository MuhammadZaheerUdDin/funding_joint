<?php

namespace App\Model\Bank;

use Illuminate\Database\Eloquent\Model;

class BankDetails extends Model
{
    //
   protected $table = 'bank_details';

//    protected $fillable = ['bank_name','account_name','sort_code','account_number','swift','iban','bic'];  KK20210905
    protected $fillable = ['bank_name','account_name','sort_code','account_number','swift','iban','bic','bank_name_1','account_name_1','sort_code_1','account_number_1','swift_1','iban_1','bic_1','bank_name_2','account_name_2','sort_code_2','account_number_2','swift_2','iban_2','bic_2','bank_name_3','account_name_3','sort_code_3','account_number_3','swift_3','iban_3','bic_3'];

 
    public function user() {

        return $this->belongsTo('App\Model\Users\User');
    }

}
