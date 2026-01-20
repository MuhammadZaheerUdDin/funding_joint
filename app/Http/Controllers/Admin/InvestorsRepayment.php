<?php
/**
 * Created by PhpStorm.
 * User: lzomedia
 * Date: 30/11/18
 * Time: 16:46
 */

namespace App\Http\Controllers\Admin;


use App\Helpers\WinningBids;
use App\Model\Auction\Auction;
use App\Model\Bank\BankDetails;
use App\Model\Bid;
use App\Model\Transaction;
use App\Model\Users\User;
use App\Notifications\UserNotification;

class InvestorsRepayment
{


    /**
     * @param $id
     * @method process
     * @return View
     * @description Process the payment of the auction the id is the auction
     */
    public function process($id)
    {


        $auction = Auction::findOrFail($id);

        $bids = $auction->bids()->get();

        $users = collect([]);

        foreach ($bids as $bid){

            $user = User::find($bid->user_id);

            $users->push($user);

            
        }


        return view('admin.auctions.repayments', compact('auction', 'users'));

    }


    /**
     * @param $investor_id
     * @param $auction_id
     * @method pay
     * @description Pays the user with the amount he invested
     */
    public function pay($investor_id, $auction_id)
    {
        $investorUser   = User::find($investor_id);
        $auction        = Auction::find($auction_id);

        $bid            = Bid::where('user_id', $investor_id)->where('auction_id', $auction_id)->first();

        if(!is_null($bid->paid ) && $bid->paid ===1){
            return redirect()->back()->with('msg','Investor already been paid for this auction');
        }

        $amount         = WinningBids::investorReturn($bid->amount,$bid->bid_discount) ;

        //Creating a new transaction reference
        $reference      =  AdminTransactionsController::createReference($investorUser->id);

        //create new transaction for the payment
        $transaction    = Transaction::create([
            'reference'=>$reference,
            'amount' => $amount,
            'user_id'=>$investorUser->id,
            'type'=>Transaction::CREDIT,
            'description'=>"Investment return for :". $auction->buyer->company_name,
            'status'=>'Complete',
            'confirmed'=>'1',
            'new_balance' => $investorUser->balance_amount
        ]);

        //change investor's balance
        $investorUser->balance->update([
            'balance' => $investorUser->balance->balance += $amount
        ]);

        //mark the bid as paid
        $bid->update([
            'paid'=>1
        ]);
        //send notification to investor
        $this->sendInvestorRePayment($investorUser,$auction);

        return redirect()->back()->with('msg', 'Payment Sent');

    }

    public function sendInvestorRePayment(User $user,Auction $auction){
        $not_title = config('notifications.investor.repayment_received');
        $not_body = 'Admin released your profit '. $auction->buyer->company_name . '( $auction->id )';
        $not_link  = route('auction.details',$auction->id);

        $notification = new UserNotification($not_title,$not_body,$not_link);

        NotificationsController::sendToUser($user,$notification);
        return $user;
    }
    
}