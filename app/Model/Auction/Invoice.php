<?php

namespace App\Model\Auction;

use App\Model\Users\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;



class Invoice extends Model
{
    protected $table = 'invoices';

    protected $fillable = ['user_id','approved','auction_id','invoice_file_name',''];


    public static function getInvoiceId($id) {


        $result = DB::table('invoices')->where('auction_id',$id)->first();

        if($result == null) {
           return 'no-upload';
        } else {
            return $result->id;
        }


    }

    public function auction(){
        return $this->belongsTo(Auction::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
