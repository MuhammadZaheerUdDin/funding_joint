<?php

namespace App\Model\Auction;

use App\Model\Bid;
use App\Model\Buyer\Buyer;
use App\Model\Buyer\BuyerTransaction;
use App\Model\PurchaseOrder;
use App\Model\Users\Investor;
use App\Model\Users\Seller;
use App\Model\Users\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravelista\Comments\Commentable;

class Auction extends Model
{

    use Commentable;


    protected $table = 'auctions';

    protected $dates = ['end_auction','date_repayment_due'];

    protected $fillable = ['approved', 'start_auction', 'end_auction', 'status','po_approved','po_file_name', 'expected_invoice_issue_date'];


    /*
     * ========== Attributes functions
     */

    /**
     * Get the average bid discount for all bids for an auction
     */

    public function getAverageBidDiscount($id)
    {

        return DB::select("SELECT sum(bid_discount) / count(*) as avg_bids FROM bids WHERE auction_id=$id");


    }

    public function getBidAmountTotal($id)
    {
        return DB::select("SELECT sum(amount) as total_bid FROM bids WHERE auction_id=$id");
    }

    /**
     * @method
     * @description Get average bid discount
     * @return int
     */
    public function getAverageBidDiscountAttribute(){
        return $this->bids->avg('bid_discount') ?:0;
    }





    /**
     * best bids which reach the funding target on after auction end
     */
    public function getWinningBids()
    {

    }

    /**
     * Get the remaining percentage of funds required
     * TODO: Check totalamount of po
     */
    public function getFundsRemainingPercentageAttribute()
    {
        if($this->amount_funding_required > 0 )
            $percentage = ($this->amount_funding_required  -  $this->amount_total_funded) / $this->amount_funding_required * 100;
        else
            $percentage =0;
        
//        if($this->amount_total_funded > $this->amount_funding_required)
//            $percentage = 100;
        return round($percentage);
    }


    public function getTotalFundedPercentageAttribute(){

        $percentage = 0;
        if ($this->amount_funding_required > 0)
            $percentage = ($this->amount_total_funded / $this->amount_funding_required) * 100;

        return round($percentage);
    }

    //Current ROI calculation before bid
    public function getBeforeBidROI(){
        $before_roi =  ($this->maximum_discount_limit / 100) * 100 / (1 - ($this->maximum_discount_limit / 100));
        return $before_roi;

    }


    /**
     * Get remaining percentage of funds required
     * TODO: Check totalamount of po
     */
    public function getAmountFundingRemainingAttribute()
    {
        if ($this->amount_funding_required !== NULL && $this->amount_funding_required > 0)
            return ($this->amount_funding_required - $this->amount_total_funded);
    }

    /**
     *
     */
    public function getTimeLeftBeforeEndAttribute()
    {
        $days_left = -1;
        $now = Carbon::now();
        if ($this->end_auction && !$this->end_auction->isPast()) {
            return $days_left = $this->end_auction->diffInDays($now);
        }
        if (is_null($this->start_auction) && is_null($this->end_auction)) {
            $days_left = -2;
        }
        return $days_left;
    }

    /**
     * @desription Return percentage of days left
     * @return float
     */
    public function getTimeLeftPercentageAttribute()
    {
        if (!is_null($this->start_auction) && !is_null($this->end_auction)) {
            $startPer = date_create($this->start_auction);

            $endPer = date_create($this->end_auction);

            $datePer = date_diff($startPer, $endPer);

            $dateTotal = $datePer->format("%a");

            //dd($dateTotal);

            if($dateTotal == "0"){
               return 0;  
            }else{
                $dateRemain = $this->time_left_before_end;
                $dateMinus = $dateTotal - $dateRemain;
                return $percentage = round(($dateMinus * 100) / $dateTotal);  
            }
        } else return 0;

    }

    public function getInvestmentPeriodAttribute()
    {
        $start = Carbon::parse($this->end_auction);
        $end = Carbon::parse($this->date_repayment_due);
        return $start->diffInDays($end);

    }

    public function getAmountTotalFundedAttribute()
    {
        return $this->bids->sum('amount');
    }

    public function getTotalBidsPlacedAttribute()
    {
        return $this->bids()->count();
    }

    public function getEndAuctionAttribute($value)
    {
        if (!is_null($value))
            return Carbon::parse($value);
    }


    public function getInvestorHasBidAttribute()
    {
        return $this->loggedInInvestorBid();
    }

    public function getInvestorBidAmountAttribute()
    {
        return $this->loggedInInvestorBid() ? $this->loggedInInvestorBid()->amount : 0;
    }

    public function getInvestorBidDiscountAttribute()
    {
        return $this->loggedInInvestorBid() ? $this->loggedInInvestorBid()->bid_discount : 0;
    }

    /**
     * Return if auctions is live
     * @return bool
     */
    public function getIsLiveAuctionAttribute()
    {

        return ($this->approved == 1);

    }

    /**
     * Return Live Auctions
     * @param $query
     * @return mixed
     */
    public function scopeIsLive($query)
    {

        return $query->where([
            ['end_auction', '>', now()],
            ['approved', '=', 1]
        ]);

    }

    /**
     * Return Cancelled Auctions
     * @param $query
     * @return mixed
     */
    public function scopeIsCancelled($query)
    {
        return $query->where([
            ['approved', '=', 2]
        ]);
    }


    /**
     * @method EndedAuctions
     * @description Get auctions that has ended
     * @param $query
     * @return mixed Auction collection
     */
    public function scopeEndedAuctions($query)
    {
        return $query->where('end_auction', '<', Carbon::now())->where('status', '=', 'Ended');
    }


    /**
     *@method Get repayments overdue
     * $return int
     */
    public function scopeRepaymentsOverDue($days = 3)
    {
        $endedAfterThreeDays = Carbon::now()->addDays($days);
        $auctions = Auction::where('date_repayment_due','>' ,$endedAfterThreeDays)->count();
        return $auctions;
    }

    /**
     * get successfully Auctions
     * @param $query
     * @return mixed
     */
    public function scopeSuccessfullAuctions($query){
        return $query->EndedAuctions()->where('paid_back', '=', '1');
    }

    /**
     * get unsuccessfully Auctions
     * @param $query
     * @return mixed
     */
    public function scopeUnSuccessfullAuctions($query){
        return $query->EndedAuctions()->where('paid_back', '=', '0');
    }
    public function getRepaymentOverdueDaysAttribute(){
        $now = Carbon::now();
        if(!is_null($this->date_repayment_due))
            return $this->date_repayment_due->diffInDays($now);

        return 0;
    }


    public function getMaxDiscountAttribute()
    {
        return $this->bids->max('bid_discount');
    }


    public function getCompanyNameAttribute()
    {
        return $this->seller->company_name;
    }

    public function getFundingSuccessAttribute()
    {
        return $this->amount_total_funded >= $this->amount_funding_required;
    }


    public function getWinnerInvestor()
    {

    }


    public function getEndedAttribute(){
        return $this->approved && $this->end_auction < Carbon::now();
    }

    /*
        * ========== Relations functions
        */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'user_id', 'user_id');
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'buyer_id', 'id');
    }

    public function buyertransaction()
    {
        return $this->hasMany(BuyerTransaction::class);
    }


    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    


    public function loggedInInvestorBid()
    {
        $user = Auth::user();
        return $this->bids()->where('user_id', $user->id)->first();
    }

     public function WithoutloggedInInvestorBid()
    {
        $user = Auth::user();
        return $this->bids()->whereNotIn('user_id', $user->id)->first();
    }

    public function purchase_order()
    {
        return $this->hasOne(PurchaseOrder::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

}