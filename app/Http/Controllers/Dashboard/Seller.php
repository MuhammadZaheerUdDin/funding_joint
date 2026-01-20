<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 11/1/2018
 * Time: 10:29 AM
 */

namespace App\Http\Controllers\Dashboard;

use App\Helpers\WinningBids;
use App\Http\Controllers\Dashboard\Interfaces\RenderDashboardInterface;
use Illuminate\Support\Facades\Auth;
use App\Model\Auction\Auction;
use Carbon\Carbon;
use App\Model\Bid;
use Illuminate\Support\Facades\DB;
use DateTime;

class Seller implements RenderDashboardInterface
{

    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function render()
    {

        $now = Carbon::now();

        $successfullAuctions = WinningBids::successfullBidsToDate($this->user->id);
        $creditLimit = $this->user->seller->credit_limit;

        $liveAuctions = count(Auction::where([[ 'user_id','=',$this->user->id ]])->where('approved','=',1)->where('end_auction','>=', $now)->get());
        /*print_r('<pre>');
        print_r($liveAuctions);
        exit;*/
        // Begin of KK20210823 - Swapped round the calculations..as the 
        // $total_funding_achieved = $this->onGetTotalFunding();
        // $total_funding_required = $this->onGetTotalFundingRequired();
        $total_funding_required = $this->onGetTotalFunding();
        $total_funding_achieved = $this->onGetTotalFundingRequired();
        // End of KK20210823

        // print_r($total_funding_achieved);
        // print_r('<br>');
        // print_r($total_funding_required);
        // exit;
        if($total_funding_required!=0){
            $overall_discount = round((1 - ($total_funding_achieved / $total_funding_required) ) * 100,2) ;
        }else{
            $overall_discount = 0;
        }

        $today_date = date('Y-m-d');
        $date = strtotime($today_date);
        $date = strtotime("-7 day", $date);
        $old_date = date('Y-m-d', $date);

        $seller_id = auth()->user()->id;

        $Due =  DB::select('SELECT * FROM `buyer_transactions` WHERE auction_id NOT IN (SELECT auction_id  FROM `buyer_transactions` WHERE `outstanding_balance` = 0  ) AND auction_id IN (SELECT id  FROM `auctions` WHERE `user_id` = '.$seller_id.'  ) AND `invoice_repayment_due_date` < "'.$today_date.'" AND `invoice_repayment_due_date` > "'.$old_date.'"  GROUP BY auction_id ORDER BY `buyer_transactions`.`created_at` DESC');

        $Overdue =  DB::select('SELECT * FROM `buyer_transactions` WHERE auction_id NOT IN (SELECT auction_id  FROM `buyer_transactions` WHERE `outstanding_balance` = 0  ) AND auction_id IN (SELECT id  FROM `auctions` WHERE `user_id` = '.$seller_id.'  ) AND `invoice_repayment_due_date` < "'.$old_date.'"  GROUP BY auction_id ORDER BY `buyer_transactions`.`created_at` DESC');
        

        //$overall_discount = round($total_funding_required,2) ;
        
        $notifications = new Cards('Notifications', $this->getUnreadNotificationsCount(),6,'/notifications');

        $creditLimit = new Cards('Credit Limit', $creditLimit,6,'#');

        $paymentsDue = new Cards('Repayments Due',count($Due),4,'/buyers/duepayment');

        $paymentsOverDue = new Cards('Repayments Overdue',count($Overdue),4,'/buyers/overduepayment');

        //$auctions = new Cards('Live Auctions', $liveAuctions,4,'/marketplace?AuctionStatus=live');
        $auctions = new Cards('Live Auctions', $liveAuctions,4,'/my-auctions?AuctionStatus=Live');


        $cards = collect([]);

        $cards->push($notifications);
        $cards->push($creditLimit);
        $cards->push($paymentsDue);
        $cards->push($paymentsOverDue);

        $cards->push($auctions);

        return view('dashboard.index-seller',compact(['cards','total_funding_achieved','overall_discount'],'successfullAuctions'));
    }

    /**
     * @met getUnreadNotificationsCount
     * @return int
     */
    public function getUnreadNotificationsCount()
    {
       return count($this->user->unreadNotifications()->get());
    }

    public function onGetTotalFunding()
    {
    	$allAuction = Auction::where('user_id',$this->user->id )->where('approved','=',1)->pluck('id')->toArray();

    	$all_accepted_bid = Bid::where('accepted_amount','>' ,0 )->whereIn('auction_id',$allAuction)->get();

        $total_funding_achieved_amount = 0;
        foreach ($all_accepted_bid as $key => $value) {
        	$total_funding_achieved_amount += $value->accepted_amount;
            // print("<pre>".print_r($value->auction_id,true)."</pre>");
            // print("<pre>".print_r($total_funding_achieved_amount,true)."</pre>");
        }
        return  round($total_funding_achieved_amount);
    }

    public function onGetTotalFundingRequired()
    {
        $allAuction = Auction::where('user_id',$this->user->id )->where('approved','=',1)->where('status','=','Ended')->get();
        $total_funding_required = 0;
        
        foreach ($allAuction as $key => $value) {
            
            $all_accepted_bid = Bid::where('accepted_amount','>' ,0 )->where('auction_id',$value->id)->first();
            if(!empty($all_accepted_bid)){
                $total_funding_required += $value->amount_funding_required;
            }
        }
        return  round($total_funding_required);
    }
}
