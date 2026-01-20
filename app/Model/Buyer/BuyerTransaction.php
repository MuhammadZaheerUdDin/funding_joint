<?php

namespace App\Model\Buyer;

use App\Model\Auction\Auction;
use Illuminate\Database\Eloquent\Model;

class BuyerTransaction extends Model
{
    protected $table = 'buyer_transactions';
    public function auction(){
        return $this->belongsTo(Auction::class);
    }

}
