<?php
/**
 * NOTE Auction details are taken from the auction not the admin settings
 * as each auction settings are saved at time of auction creation
 *
 */

namespace App\Helpers;

use App\Model\Users\Users;

use App\Helpers\UserHelper;
use App\Model\Auction\Auction;
use App\Model\Users\Investor;
use App\Model\Bid;
use App\Model\Users\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

/**
 * Class WinningBids
 * @package App\Helpers
 *
 *
 *
 */
class WinningBids
{

    public static function getResults($auctionId)
    {


        $auction = Auction::with(['bids', 'user', 'seller'])->findOrfail($auctionId);
        $bids = $auction->bids()->with('investor')->orderBy('bid_discount', 'asc')
            ->orderBy('amount', 'desc')
            ->get();

        $total = 0;

        $winners = array();

        foreach ($bids as $bid) {

            $total += $bid['amount'];
            // create array details
            $winners[] = $bid;

            // exact funding
            if ($total === $auction->amount_funding_required) {

                break;

            } else {
                // do nothing
            }

        }

        return array('winners' => $winners);

    }

    /**
     * take this off the funding given to a seller
     */
    public static function transferAmountToSeller($id)
    {

        $auction = Auction::with(['bids', 'user', 'seller'])->findOrfail($id);

        $DeductInvestorsCut = 0;
        $TotalFunded = 0;

        $winners = self::getResults($id);
        foreach ($winners['winners'] as $winning_bids) {

            $DeductInvestorsCut += self::investorReturn($winning_bids->amount, $winning_bids->bid_discount);
            $TotalFunded += $winning_bids->amount;
        }

        // funding joint fee in %
        $fundingJointFee = self::fundingJointFee($TotalFunded, $auction->funding_joint_fee);

        // minus amount funding achieved and funding joint fee
        $totalPayout = ($TotalFunded - ($DeductInvestorsCut + $fundingJointFee));

        // can use later
        //return array('totalPayout' => $totalPayout,'fjFee' => $fundingJointFee,'auctionTotalAchieved' => $TotalFunded,'investorsCut' => $DeductInvestorsCut);
        return $totalPayout;
    }

    /**
     * return Investor's profit from the aucton, using his bid and  his bid discount
     * function calculate the bid_discount investor made for winning bid, deduct off total auction amount achieved
     */
    public static function investorReturn($amount, $bid_discount)
    {
        //Formula
        //(bid.amount / (1 - ( bid.discount / 100))         (yes, this is it )

        // print_r("hhhh");

        // print_r($amount); print_r($bid_discount); die;

        // $profit = round($amount / (1 - ( $bid_discount / 100) ),2 ) ;

        // return $profit;
    }

    public static function fundingJointFee($totalAmount, $FJFee)
    {
        $total = ($totalAmount * 2.99 / 100);
        //$total = ($totalAmount * $FJFee / 100);
        return $total;
    }

    // for seller and admin
    public static function successfullBidsToDate($userId)
    {

        $user = Auth::user();

        $now = Carbon::now();
        $successfullAuctions = 0;
        $repaymentsDue = 0;
        $repaymentsComplete = 0;
        $releaseFunds = 0;


        // select auction where approved and auction has ended if admin do not use where
        if ($user['user_type'] === 1) {
            $auctions = Auction::with(['bids', 'user', 'seller'])
                ->where('approved', '=', 1)->where('end_auction', '<', $now)
                ->get();
        } else {
            $auctions = Auction::with(['bids', 'user', 'seller'])->where('user_id', $userId)
                ->where('approved', '=', 1)->where('end_auction', '<', $now)
                ->get();
        }

        // did auction bids add up to and meet funding target at auction end, for each auction
        $total = 0;
        $totalBidDiscount = 0;
        $totalFunded = 0;
        foreach ($auctions as $auction) {

            if ($auction->paid_out === 1 && $auction->paid_back === 0):
                $repaymentsDue += 1;
            endif;
            if ($auction->paid_out === 1 && $auction->paid_back === 1):
                $repaymentsComplete += 1;
            endif;
            if ($auction->paid_out === 0 && $auction->paid_back === 0):
                $releaseFunds += 1;
            endif;

            $winners = array();

            $bids = $auction->bids()->with('investor')->orderBy('bid_discount', 'asc')
                ->orderBy('amount', 'desc')
                ->get();

            foreach ($bids as $bid) {

                $total += $bid['amount'];
                // create array details
                $winners[] = $bid;

                // exact funding
                if ($total === $auction->amount_funding_required) {
                    // add successfull auctions or break
                    // total bid discount added together
                    $successfullAuctions += 1;
                    $totalBidDiscount += $bid->bid_discount;
                    $totalFunded += $auction->amount_funding_required;

                    break;

                } else {
                    // do nothing
                }
            }
        }
        
        if ($successfullAuctions == 0):
            $totalBidDiscount = 0;
            $totalFunded = 0;
            $repaymentsDue = 0;
            $successfullAuctions = 0;
            $repaymentsComplete = 0;
            $releaseFunds = 0;
        endif;

        return array('totalBidDiscount' => $totalBidDiscount,'total'=>$total ,'totalFunded' => $totalFunded, 'repaymentsDue' => $repaymentsDue, 'successfullAuctions' => $successfullAuctions, 'repaymentsComplete' => $repaymentsComplete, 'releaseFunds' => $releaseFunds);

    }

    public static function successfullInvestmentsToDate($userId)
    {

        //get Logged in user's bids' TODO
        $bids = Bid::where('user_id', '=', $userId)->pluck('auction_id')->toArray();

        //Get Auctions that the currently logged in user has bid on

        //if($request->status == 'live'){
        $auctions = Auction::whereIn('id', $bids)->with(['user', 'bids'])->IsLive()->paginate(9);

    }

}