<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 11/1/2018
 * Time: 10:29 AM
 */

namespace App\Http\Controllers\Dashboard;


use App\Http\Controllers\Dashboard\Interfaces\RenderDashboardInterface;

use App\Helpers\WinningBids;
use App\Model\Transaction;
use App\Model\Users\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


use App\Model\Auction\Auction;
use App\Model\Buyer\Buyer;
use App\Model\Users\Seller;
use App\Model\Users\Investor;
use Illuminate\Support\Facades\DB;
use DateTime;

class Admin implements RenderDashboardInterface
{
    protected $user;


    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * @method render
     * @description Gets a list of admin cards
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function render()
    {

        $cards =  $this->getDefaultCards();

        $usersCards = $this->getUsersCards();

        $transactionCards = $this->getTransactionCards();

        $notifications = $this->user->notifications()->limit(5)->get();

        return view('dashboard.admin',compact(['cards', 'usersCards', 'transactionCards', 'notifications']));
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getDefaultCards()
    {

        $successfullAuctions = WinningBids::successfullBidsToDate($this->user->id);

        $today_date = date('Y-m-d');
        $date = strtotime($today_date);
        $date = strtotime("-7 day", $date);
        $old_date = date('Y-m-d', $date);

        $Overdue =  DB::select('SELECT * FROM `buyer_transactions` WHERE auction_id NOT IN (SELECT auction_id  FROM `buyer_transactions` WHERE `outstanding_balance` = 0  ) AND `invoice_repayment_due_date` < "'.$old_date.'"  GROUP BY auction_id ORDER BY `buyer_transactions`.`created_at` DESC');

        $Due =  DB::select('SELECT * FROM `buyer_transactions` WHERE auction_id NOT IN (SELECT auction_id  FROM `buyer_transactions` WHERE `outstanding_balance` = 0  ) AND `invoice_repayment_due_date` < "'.$today_date.'" AND `invoice_repayment_due_date` > "'.$old_date.'"  GROUP BY auction_id ORDER BY `buyer_transactions`.`created_at` DESC');



        $array = [

            [
                'title' => 'Notifications require Attention',
                'value' => $this->getUnreadNotificationsCount(),
                'width' => 3,
                'link'=>'/notifications'
            ],
            [
                'title' => 'Auctions Successful Release Funds',
                'value' => $successfullAuctions['releaseFunds'],
                'width' => 3,
                'link'=>'/marketplace?AuctionStatus=successfull'
            ],
            [
                'title' => 'Repayments Complete',
                'value' => count($Due),
                'width' => 3,
                'link'=>'/auctions'
            ],
            [
                'title' => 'Repayments Overdue',
                'value' => count($Overdue),
                'width' => 3,
                'link'=>'/buyers/overduepayment'
            ],
            [
                'title' => 'Repayments Due',
                'value' => count($Due),
                'width' => 3,
                'link'=>'/buyers/duepayment'
            ],
            [
                'title' => 'Live Auctions',
                'value' => $this->getLiveAuctions(),
                'width' => 3,
                'link'=>'/auctions?AuctionStatus=live'
            ],
            [
                'title' => 'Successful Auctions',
                'value' => $successfullAuctions['successfullAuctions'],
                'width' => 3,
                'link'=>'/auctions?AuctionStatus=complete'
            ],
            [
                'title' => 'Unsuccessful Auctions',
                'value' => $this->getUnSuccessfulAuctions(),
                'width' => 3,
                'link'=>'/marketplace?AuctionStatus=unsuccessfull'
            ],
        ];

        $cards = collect([]);

        foreach ($array as $item){

            $card = new Cards($item['title'], $item['value'],$item['width'],$item['link']);
            $cards->push($card);

        }

        return $cards;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getTransactionCards()
    {

        $transactionCards = collect([]);

        $transactionCards->push(new Cards('Deposits', Transaction::where('type', Transaction::CREDIT)->count(), 6,'/transactions?TransactionType=credit'));
        $transactionCards->push(new Cards('Withdrawals', Transaction::where('type', Transaction::DEBIT)->count(), 6,'/transactions?TransactionType=debit'));

        return $transactionCards;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getUsersCards()
    {
        $usersCards = collect([]);

        $usersCards->push(new Cards('Needs Approval', $this->getTotalUsersNeedsApproval(), 3,'/users?userStatus=ToApprove'));
        $usersCards->push(new Cards('Registered Sellers', $this->getTotalSellers(), 3,'/users?type=Seller'));
        $usersCards->push(new Cards('Registered Investors', $this->getTotalInvestors(), 3,'/users?type=Investor'));
        $usersCards->push(new Cards('Registered Buyers', $this->getTotalBuyers(), 3,'/buyers'));

        return $usersCards;
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
     * @method getLiveAuctions
     * @description Gets the total number of approved auctions
     * @return mixed
     */
    public function getLiveAuctions()
    {
        return Auction::IsLive()->count();
    }



    /**
     * @method getSuccessfulAuctions
     * @description Gets the total number of successful auctions
     * @return mixed
     */
    public function getUnSuccessfulAuctions()
    {
        $auctions = Auction::with('bids')->get();

        $failed = collect([]);

        foreach ($auctions as $auction){

            $totalBids = 0;

            foreach ($auction->bids()->get() as $bid){

                $totalBids =+ $bid->amount;
            }

            if($totalBids !== $auction->amount_funding_required){


                $failed->push($auction);

            }



        }

        return $failed->count();

    }

    /**
     * @method getTotalInvestors
     * @description Gets the total investors amount
     * @return int
     */
    public function getTotalBuyers()
    {
        return Buyer::count();
    }

    /**
     * @method getTotalInvestors
     * @description Gets the total investors amount
     * @return int
     */
    public function getTotalInvestors()
    {
        return Investor::count();
    }

    /**
     * @method getTotalSellers
     * @description Gets the total sellers amount
     * @return int
     */
    public function getTotalSellers()
    {
        return Seller::count();
    }


    public function getTotalUsersNeedsApproval()
    {
        return User::where('approved', 0)->where('is_completed', 1)->count();
    }
}