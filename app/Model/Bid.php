<?php

namespace App\Model;

use App\Model\Auction\Auction;
use App\Model\Users\Investor;
use App\Model\Users\User;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = [
        'user_id', 'auction_id', 'amount', 'roi','bid_discount','roi_in_pound','approved','paid'
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class, 'user_id', 'user_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function auction(){
        return $this->belongsTo(Auction::class);
    }

    /**
     * @return float|intget value of po
     * calulations...
     */
    public function getValueOfPoAttribute(){
        if($this->bid_discount > 0 )
        {
            // $po_value_data =  $this->amount * (1 + ( $this->roi / 100)) ;
            $po_value_data =  $this->amount;
            return number_format((float)$po_value_data, 2, '.', '');
        }
        if($this->bid_discount == 0){
            return $this->amount;
        }
    }

    /**get share of po %
     * @return float|int
     */
    public function getShareOfPoAttribute(){
        // print_r($this->value_of_po); die;
        $share_of_po =  $this->value_of_po / $this->auction->total_amount_of_po * 100;
        return number_format((float)$share_of_po, 2, '.', '');
    }

    /**
     * get profit of the bid
     * @return mixed
     */
    public function getProfitAttribute(){

        return $this->value_of_po - $this->amount;
        if($this->bid_discount == 0){
            return 0;
        }
    }

   
}
