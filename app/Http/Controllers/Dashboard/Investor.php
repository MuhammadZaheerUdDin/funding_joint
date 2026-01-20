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
use App\Model\Auction\Auction;
use App\Model\Bid;
use App\Model\Transaction;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DateTime;

class Investor implements RenderDashboardInterface
{

    protected $user;

    protected $cards;

    public function __construct()
    {

        $this->cards = collect([]);

        $this->user = Auth::user();
    }


    /**
     * @method render
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     * @throws \Exception
     */
    public function render()
    {
        $now = Carbon::now();

        $id = Auth::id();

        ## TODO
          // $successfullAuctions = WinningBids::successfullInvestmentsToDate($id);

        $total_amount_invested = $this->onGetAmountInvested();

        $total_roi_achieved = $this->onGetTotalRoi();

        $total_roi_achieved_amount = $this->onGetTotalRoiAmount();

        $roi_value_in_pound = $total_roi_achieved_amount - $total_amount_invested;

        if($total_amount_invested!=0){
            $roi_value_in_per = round(($roi_value_in_pound / $total_amount_invested) * 100, 2);
        }else{
            $roi_value_in_per = 0;
        }
        
        
        $total_amount_invested_percentage = $this->onGetAmountInvestedPercentage();

        $balance = new Cards('My Account Balance', $this->getAccountBalance(), 6,'/account');

        $creditLimit = new Cards('Live Investments Nearing Close', $this->closingAuctions(), 6,'/my_investments?status=live');

        $notifications = new Cards('Notifications', $this->getUnreadNotificationsCount(), 3,'/notifications');

        $paymentsDue = new Cards('Repayments Due', $this->getRepaymentsDue(), 3,'/buyers/duepayment');

        $paymentsOverDue = new Cards('Repayments Overdue', $this->getRepaymentsOverDue(), 3,'/buyers/overduepayment');

        $auctions = new Cards('Live Investments', $this->liveAuctions(), 3,'/my_investments?status=live');

        $cards = collect([]);
        $cards->push($balance);
        $cards->push($creditLimit);
        $cards->push($notifications);
        $cards->push($paymentsDue);
        $cards->push($paymentsOverDue);
        $cards->push($auctions);

        return view('dashboard.investor', compact(['cards', 'total_amount_invested', 'total_roi_achieved', 'balance', 'total_amount_invested_percentage','roi_value_in_pound','roi_value_in_per']));
    }


    /**
     * @met getUnreadNotificationsCount
     * @return int
     */
    public function getUnreadNotificationsCount()
    {
        return count($this->user->unreadNotifications()->get());
    }


    /**
     * @method Get repayments due
     * $return int
     */
    public function getRepaymentsDue()
    {
        $today_date = date('Y-m-d');
        $date = strtotime($today_date);
        $date = strtotime("-7 day", $date);
        $old_date = date('Y-m-d', $date);

        $investor_id = auth()->user()->id;
        $allBuyer =  DB::select('SELECT * FROM `buyer_transactions` WHERE auction_id NOT IN (SELECT auction_id  FROM `buyer_transactions` WHERE `outstanding_balance` = 0  ) AND auction_id IN (SELECT auction_id  FROM `bids` WHERE `user_id` = '.$investor_id.'  ) AND `invoice_repayment_due_date` < "'.$today_date.'" AND `invoice_repayment_due_date` > "'.$old_date.'"  GROUP BY auction_id ORDER BY `buyer_transactions`.`created_at` DESC');

        return count($allBuyer);


        /*$endingInThreeDays = Carbon::now()->addDays(3);
        $auctions = $this->user->investor->liveInvestments()->where('date_repayment_due', '<', $endingInThreeDays)->count();
        return $auctions;*/
    }

    /**
     * @method Get repayments overdue
     * $return int
     */
    public function getRepaymentsOverDue()
    {
        $today_date = date('Y-m-d');
        $date = strtotime($today_date);
        $date = strtotime("-7 day", $date);
        $old_date = date('Y-m-d', $date);

        $investor_id = auth()->user()->id;
        $allBuyer =  DB::select('SELECT * FROM `buyer_transactions` WHERE auction_id NOT IN (SELECT auction_id  FROM `buyer_transactions` WHERE `outstanding_balance` = 0  ) AND auction_id IN (SELECT auction_id  FROM `bids` WHERE `user_id` = '.$investor_id.'  ) AND `invoice_repayment_due_date` < "'.$old_date.'"  GROUP BY auction_id ORDER BY `buyer_transactions`.`created_at` DESC');

        return count($allBuyer);
        /*$endedBeforeThreeDays = Carbon::now()->subDays(3);
        $auctions = $this->user->investor->investments()
            ->where('date_repayment_due', '>', $endedBeforeThreeDays)
            ->count();
        return $auctions;*/
    }


    public function closingAuctions()
    {
        $endingInThreeDays = Carbon::now()->addDays(3);
        $auctions = $this->user->investor->liveInvestments()->where('end_auction', '<', $endingInThreeDays);
        return $auctions->count();
    }

    public function liveAuctions()
    {
        return $this->user->investor->liveInvestments()->count();
    }

    public function getAccountBalance()
    {
        return '£' . $this->user->balance_amount;
    }


    /**
     *
     */
    public function onCalculateTotalAmountInvestedInPercentage()
    {

        $userBalance = $this->user->balance_amount;


        if(intval($userBalance) === 0 ){
            return 0;
        }

        $total_amount_invested = Bid::where('user_id', $this->user->id)->sum('amount');

        return $total_amount_invested / $userBalance * 100;

    }

    /**
     * @method onGetAmountInvested
     * @description Get's the total amount that the current logged in investor have invested into the funding joint platform
     */
    public function onGetAmountInvested()
    {
        return  Bid::where('user_id', $this->user->id)->sum('accepted_amount');
    }

    /**
     * @method onGetAmountInvestedPercentage
     * @description Get's the total amount that the current logged in investor have invested into the funding joint platform
     */
    public function onGetAmountInvestedPercentage()
    {


        if(intval($this->user->balance_amount) === 0){

            return 0;
        }

        return $this->onGetAmountInvested() / $this->user->balance_amount * 100;
    }

    /**
     * @method onGetTotalRoi
     * @description Get's the total ROI
     */
    public function onGetTotalRoi()
    {
        return  round(Bid::where('user_id', $this->user->id)->avg('bid_discount'));
    }

    public function onGetTotalRoiAmount()
    {
        $all_accepted_bid = Bid::where('user_id', $this->user->id)->where('accepted_amount','>' ,0 )->get();
        $total_roi_achieved_amount = 0;
        foreach ($all_accepted_bid as $key => $value) {
            $roi_amount = ($value->accepted_amount * $value->roi)/100;
            $total_roi_achieved_amount += $roi_amount + $value->accepted_amount;
        }
        return  round($total_roi_achieved_amount);
    }

}