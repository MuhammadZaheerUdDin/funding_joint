<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WinningBids;
use App\Http\Controllers\Search\TransactionsSearch;
use App\Model\Transaction;
use App\Model\Users\User;
use App\Model\Admin\AdminSettings;
use App\Model\Auction\Auction;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Bid;
use Illuminate\Support\Facades\Auth;

class AdminTransactionsController extends Controller
{

    protected $transactions;


    public function index(Request $request)
    {
        $search = new TransactionsSearch();
        $transactions = $search->apply($request);
        $transactionType = $request->TransactionType;
        
        /*print_r('<pre>');
        print_r($transactions);
        exit;*/
        return view('admin.transactions.index', compact('transactions','transactionType'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirm($id)
    {
      $transaction = Transaction::with('user')->findOrFail($id);


      if (!$transaction->confimed) {
   
        if ($transaction->type == Transaction::CREDIT) {

            $new_balance = $this->creditFunds($transaction->user, $transaction->amount);

        } else {

            $new_balance = $this->debitFunds($transaction->user, $transaction->amount);
            // print_r("At Least"); print_r($new_balance);die;
        }
        $transaction->update([
            'confirmed' => 1,
            'status' => 'Complete',
            'new_balance' => $new_balance
        ]);
        return redirect()->back()->with('msg', 'Succesfully Transferred');
      }
    }

    public function decline($id)
    {
        $transaction = Transaction::with('user')->findOrFail($id);
        if (!$transaction->confimed) {

            $transaction->update([
                'confirmed' => 0,
                'status' => 'Decline'
            ]);

            $not_body = 'Admin has declined confirmation of your funds!';
            $not_link = route('user.account');
            $notification = new UserNotification('Payment Confirmation Declined', $not_body, $not_link);
            NotificationsController::sendToUser($transaction->user, $notification);

            return redirect()->back()->with('msg', 'Transaction Declined');
        }

    }



    /**
     * pay the seller after auction and send a notification
     * @param $seller
     * @param $amount
     * @return mixed
     */
    public function transferFundsToSeller(Request $request)
    {

        $seller = $request->get('seller');
        $auction_id = $request->get('auction_id');
        
        $user = User::with(['seller'])->findOrfail($seller);
        $auction = Auction::find($auction_id);
        $admin = User::find(1);

        //Check if it is not already paidout
       if($auction->paid_out !=1){
           try {

               $auction->paid_out = 1;
               $auction->paid_out_datetime = date('Y-m-d H:i:s');
               $auction->paid_out_reference = $request->get('paid_out_reference');
               $auction->save();

               //self::transferFundsToAdmin($auction);

               $user->balance->update([
                   'balance' => $user->balance->balance += $request->get('amount')
               ]);

               $admin->balance->update([
                   'balance' => $admin->balance->balance -= $request->get('amount')
               ]);

               //echo "this is test";die;

               $user->transactions()->create([
                   'amount' =>$request->get('amount'),
                   'reference'=> self::createReference($user->id),
                // 'new_balance'    =>$user->balance_amount,   KK20210821
                   'new_balance'    =>$user->balance->balance,    //KK20210821
                   'type'=> Transaction::CREDIT,
                   'status'=>'Complete',
                   'remarks'       =>'Investment',
                   'auction_id'=>$auction->id,
                   'confirmed' =>1,
                   'description' => 'Released funds for auction : ' . $auction->buyer->company_name.', Auction #'.$auction_id
               ]);

               $admin->transactions()->create([
                   'amount' =>$request->get('amount'),
                   'reference'=> self::createReference($admin->id),
                // 'new_balance'    =>$admin->balance_amount,   KK20210821
                   'new_balance'    =>$admin->balance->balance,    //KK20210821
                   'type'=> Transaction::DEBIT,
                   'status'=>'Complete',
                   'remarks'       =>'Investment',
                   'auction_id'=>$auction->id,
                   'confirmed' =>1,
                   'description' => 'Released funds for auction : ' . $auction->buyer->company_name.', Auction #'.$auction_id
               ]);

               //withdraw funds

                /*$transaction = Transaction::create([
                    'user_id' => $user->id,
                    'description' => 'Withdrawal',
                    'amount' => $amount,
                    'type' => Transaction::DEBIT,
                    'reference' => self::createReference($user->id),
                ]);*/

                //print_r($transaction);die;

                $userid = $user->id;

                //$this->sendWithdrawRequestNotificationFor($transaction,$userid);

           } catch (\Exception $exception) {
               logger()->error($exception);
               return redirect()->back();
           }

           //$not_body = 'Admin has confirmed auction funds transfer to your account!';
           $not_body = 'Payment for auction # '. $auction->id . ' has been released and credited to your wallet.';
           $not_link = route('user.account');
           $notification = new UserNotification(config('notifications.seller.payment_received'), $not_body, $not_link);
           NotificationsController::sendToUser($user, $notification);
           return redirect("/auctions/$auction_id");
       }
       else
           return redirect()->back()->withMessage('Already Paid out!');


    }

    /**
     * pay the Investor after auction and send a notification
     * @param $investor
     * @param $amount
     * @return mixed
     */
    public function transferFundsToInvestor(Request $request)
    {

        $investor_id = $request->get('investor');
        $auction_id = $request->get('auction_id');

        $investorUser   = User::find($investor_id);
        $auction        = Auction::find($auction_id);

        $bid            = Bid::where('user_id', $investor_id)->where('auction_id', $auction_id)->first();
        // print("<pre>".print_r($investor_id,true)."</pre>");
        // print("<pre>".print_r($auction_id,true)."</pre>");
        // print("<pre>".print_r($bid,true)."</pre>");die;
        if(!is_null($bid->paid ) && $bid->paid ===1){
            return redirect()->back()->with('msg','Investor already been paid for this auction');
        }
        
        $amount         = str_replace( ',', '', $request->get('amount')) ;
        //Creating a new transaction reference
        $reference      =  $request->get('investor_reference');

        $admin          = Auth::user();
        /*print_r('<pre>');
        print_r($admin);
        exit;
        print_r('<pre>');
        print_r($admin->balance->balance);
        print_r('<br>');
        print_r($amount);
        exit;*/
        // print("<pre>".print_r($amount,true)."</pre>");

        //change investor's balance
        $investorUser->balance->update([
            'balance' => $investorUser->balance->balance += $amount
        ]);
        // print("<pre>".print_r($investorUser->balance->balance,true)."</pre>");

        //create new transaction for the payment
        $transaction    = Transaction::create([
            'reference'=>$reference,
            'amount' => $amount,
            'user_id'=>$investorUser->id,
            'type'=>Transaction::CREDIT,
            'description'=>"Investment return for : ". $auction->buyer->company_name. ", Auction #".$auction_id,
            'status'=>'Complete',
            'remarks'       =>'Investment',
            'auction_id'=>$auction_id,
            'confirmed'=>'1',
            // 'new_balance' => $investorUser->balance_amount   KK20210821
            'new_balance' => $investorUser->balance->balance    //KK20210821
        ]);



        $admin->balance->update([
            'balance' => $admin->balance->balance -= $amount
        ]);

        $admin->transactions()->create([
            'amount'      =>$amount,
            'reference'   => self::createReference($admin->id),
            'new_balance' =>$admin->balance_amount,
            'type'        => Transaction::DEBIT,
            'status'      =>'Complete',
            'auction_id'  =>$auction->id,
            'confirmed'   =>1, 
            'description' => '',
            'remarks'       =>"Auction #".$auction_id. " payout",
        ]);

        //mark the bid as paid

        Bid::where('user_id', $investor_id)->where('auction_id', $auction_id)
              ->update(['reference' => $reference,'paid'=>1,'paid_datetime'=>date('Y-m-d H:i:s')]);
        
        $not_title = config('notifications.investor.repayment_received');
        //$not_body = 'Admin released your profit '. $auction->buyer->company_name . ', Auction #' .$auction->id;
        $not_body = 'Payment for auction # '. $auction->id . ' has been released and credited to your wallet.';
        $not_link  = route('user.account');

        $notification = new UserNotification($not_title,$not_body,$not_link);

        NotificationsController::sendToUser($investorUser,$notification);

        return redirect("/auctions/$auction_id");


    }



    /**
     * pay the seller after auction and send a notification
     * @param $seller
     * @param $amount
     * @return mixed
     */
    public function transferFeesToSeller(Request $request)
    {

        $seller = $request->get('seller');
        $auction_id = $request->get('auction_id');

        $user = User::with(['seller'])->findOrfail($seller);
        $auction = Auction::find($auction_id);
        $admin = User::find(1);

        //Check if it is not already paidout
       if($auction->fees_release !=1){
           try {

               $auction->fees_release = 1;
               $auction->fees_release_datetime = date('Y-m-d H:i:s');
               $auction->fees_release_reference = $request->get('agency_fee_reference');
               $auction->save();

               //self::transferFundsToAdmin($auction);

               $user->balance->update([
                   'balance' => $user->balance->balance += $request->get('amount')
               ]);

               $admin->balance->update([
                   'balance' => $admin->balance->balance -= $request->get('amount')
               ]);


               //echo "this is test";die;

               $user->transactions()->create([
                   'amount'         =>$request->get('amount'),
                   'reference'      => self::createReference($user->id),
                //    'new_balance'    =>$user->balance_amount,   KK20210821
                   'new_balance'    =>$user->balance->balance,    //KK20210821
                   'type'           => Transaction::CREDIT,
                   'status'         =>'Complete',
                   'remarks'        =>'Investment',
                   'auction_id'     =>$auction_id,
                   'confirmed'      =>1,
                   'description'    => 'Released funds for auction : ' . $auction->buyer->company_name.', Auction #'.$auction_id
               ]);

               $admin->transactions()->create([
                   'amount'       =>$request->get('amount'),
                   'reference'    => self::createReference($admin->id),
                //    'new_balance'    =>$admin->balance_amount,   KK20210821
                   'new_balance'    =>$admin->balance->balance,    //KK20210821
                   'type'         => Transaction::DEBIT,
                   'status'       =>'Complete',
                   'remarks'      =>'Investment',
                   'auction_id'   =>$auction_id,
                   'confirmed'    =>1,
                   'description'  => 'Released funds for auction : ' . $auction->buyer->company_name.', Auction #'.$auction_id
               ]);

               //withdraw funds

               /* $transaction = Transaction::create([
                    'user_id' => $user->id,
                    'description' => 'Withdrawal',
                    'amount' => $amount,
                    'type' => Transaction::DEBIT,
                    'reference' => self::createReference($user->id),
                ]);*/

                //print_r($transaction);die;

                $userid = $user->id;

                //$this->sendWithdrawRequestNotificationFor($transaction,$userid);

           } catch (\Exception $exception) {
               logger()->error($exception);
               return redirect()->back();
           }

           //$not_body = 'Admin has confirmed auction funds transfer to your account!';
           $not_body = 'Payment for auction # '. $auction->id . ' has been released and credited to your wallet.';
           $not_link = route('user.account');
           $notification = new UserNotification(config('notifications.seller.payment_received'), $not_body, $not_link);
           NotificationsController::sendToUser($user, $notification);
           return redirect("/auctions/$auction_id");
       }
       else
           return redirect()->back()->withMessage('Already Paid out!');


    }

    public function sendWithdrawRequestNotificationFor($transaction,$userid)
    {
        $user = User::find($userid);
        $not_body = ucfirst($user->getRole()) . '- ' . $user->email . ' Requested to withdraw funds, review and confirm';
        $not_link = route('admin.transactions', ['id' => $transaction->id]);
        $notification = new AdminNotification('User Withdraws Funds', $not_body, $not_link);
        NotificationsController::sendToAdmins($notification);
    }


    public function transferFundsToAdmin(Auction $auction){

        $admin                  = Auth::user();
        $auction_funding_fee    = AdminSettings::first();
        $funding_fee            = $auction_funding_fee->funding_joint_admin_fee;
         
        $admin_fee = WinningBids::fundingJointFee($auction->amount_funding_required,$funding_fee);
        $admin->balance->update([
            'balance' => $admin->balance->balance += $admin_fee
        ]);


        $admin->transactions()->create([
            'amount' =>$admin_fee,
            'reference'=> self::createReference($admin->id),
      //    'new_balance'    =>$admin->balance_amount,   KK20210821
            'new_balance'    =>$admin->balance->balance,    //KK20210821
            'type'=> Transaction::CREDIT,
            'status'    =>'Complete',
            'auction_id'=>$auction->id,
            'confirmed' =>1,
            'description' => 'Funding Joint Fee for auction : ' . $auction->buyer->company_name. ', Auction #'. $auction->id
        ]);

        //print_r($admin->transactions);die;

    }

    /**
     * Credit User with funds and send a notification
     * @param $user
     * @param $amount
     * @return mixed
     */
    public function creditFunds($user, $amount)
    {
        $user->balance->update([
            'balance' => $user->balance->balance += $amount
        ]);
        $not_body = 'Admin has confirmed your funds!';
        $not_link = route('user.account');
        $notification = new UserNotification(config('notifications.investor.payment_received'), $not_body, $not_link);
        NotificationsController::sendToUser($user, $notification);
        return $user->balance->balance;
    }

    /**
     * Debit user funds and send a notification
     * @param $user
     * @param $amount
     * @return mixed
     */
    public function debitFunds($user, $amount)
    {
        $user->balance->update([
            'balance' => $user->balance->balance -= $amount
        ]);
        $not_body = 'Admin has released your funds!';
        $not_link = route('user.account');
        $notification = new UserNotification(config('notifications.investor.payment_received'), $not_body, $not_link);
        NotificationsController::sendToUser($user, $notification);
        // return $user->balance_amount;  KK20210720
        return $user->balance->balance;   // KK20210720
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createTransaction(Request $request)
    {

        $transaction = Transaction::create([
            'user_id' => $request->user,
            'amount' => $request->amount,
            'reference' => $request->reference,
            'type' => $request->type,
            'auction_id' => $request->auction_id,
            'description' => $request->description,
            'status' => 'Transfer Funds'
        ]);
        if ($transaction->exists) {
            $this->confirm($transaction->id);
        }
        return redirect()->back()->with('msg', 'Transaction Completed successfully');
    }

    /**
     * @method createReference
     * @param $user_id
     * @description Create a random string transaction reference with name initials userid and timestamp.
     *  example: KZ_14_1542726173
     * @return string
     */
    public static function createReference($user_id)
    {
        
        $user = User::findOrFail($user_id);

        if($user->getRole() == "seller")
            $reference = $user->getNameInitials()."_". $user->id ."_" . time();
        elseif($user->getRole() == "investor")
                $reference = $user->getnameInitials()."_". $user->id ."_" . time();
        else $reference = "FundingJoint ". $user->id ."_" . time();
        return $reference;
    }

    /**
     * @method onExportTransactions
     * @descriptions Generates the export logic
     */
    public function onExportTransactions()
    {
        return (new Collection([$this->transactions]))->downloadExcel(
            'transactions.csv',
            $writerType = null,
            $headings = true
        );
    }

    /**
     * @method setTransactions
     * @param $transactions
     * @description Sets the transactions
     */
    public function setTransactions($transactions)
    {
        $this->transactions = $transactions;

    }


}


