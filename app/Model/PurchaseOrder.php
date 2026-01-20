<?php

namespace App\Model;

use App\Model\Auction\Auction;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $table = 'purchase_orders';
    protected $fillable = ['auction_id','approved'];

    public function auction(){
        return $this->belongsTo(Auction::class,'auction_id','id');
    }
}
