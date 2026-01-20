<?php

namespace App\Http\Controllers\Bid;

use App\Http\Controllers\Account\AccountBalanceController;
use App\Http\Controllers\Admin\AdminTransactionsController;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Requests\BidRequest;
use App\Model\Auction\Auction;
use App\Model\Bid;
use App\Model\Transaction;
use App\Model\Users\Investor;
use App\Model\Users\User;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminNotification;

use Carbon\Carbon;

class BidsController extends Controller
{
    public function placeBid(Request $request, $id)
    { 
        
        $user = Auth::user();
        $admin  = User::where('id',1)->first();
        
        $auction = Auction::where('id',$id)->first();

        if($request->roi == 0){
            $this->sendNotificationToSellerForAuctionEnd($auction);
            $today = Carbon::now();
            if($auction->amount_funding_required == $request->amount){
                $update = Auction::where('id', $id)->update([
                    'status'       => 'Ended',
                    'end_auction'  =>  $today,
                    'auction_completed' => 1
                ]);

                // $otherAllInvestor = Bid::where('auction_id', $id)->get();
                
                // foreach ($otherAllInvestor as $key => $value) {
                //     $investorUser   = User::find($value->user_id);
                //     $auction        = Auction::find($id);

                //     $amount         = $value->amount;
                //     //Creating a new transaction reference
                //     $reference      =  AdminTransactionsController::createReference($investorUser->id);
                    
                //     $updated_amount = $investorUser->balance_amount + $amount;
                    
                //     //change investor's balance
                //     $investorUser->balance->update([
                //         'balance' => $updated_amount
                //     ]);

                //     //create new transaction for the payment
                //     $transaction    = Transaction::create([
                //         'reference'=>$reference,
                //         'amount' => $amount,
                //         'user_id'=>$investorUser->id,
                //         'type'=>Transaction::CREDIT,
                //         'description'=>"Investment refunded: ". $auction->buyer->company_name,
                //         'status'=>'Complete',
                //         'confirmed'=>'1',
                //         'new_balance' => $updated_amount
                //     ]);

                //     $not_title = config('notifications.investor.repayment_received');
                //     $not_body = 'Admin released your unaccepted bid '. $auction->buyer->company_name . '( $auction->id )';
                //     $not_link  = route('auction.details',$auction->id);

                //     $notification = new UserNotification($not_title,$not_body,$not_link);

                //     NotificationsController::sendToUser($investorUser,$notification);
                // }
            }  
        }
        
        //print_r($request->roi_pound);die;
    
        $bid = Bid::create([
            'user_id' => $user->id,
            'auction_id' => $auction->id,
            'approved' =>1,
            'roi'=>$request->roi,
            'roi_in_pound' => $request->roi_pound
        ]);
        // print("<pre>".print_r($request->roi,true)."</pre>");die;
        $bid->update($request->all());

        $this->sendOutBidNotification($auction, $request);
        $this->sendNotificationToSeller($auction);
        $reference = AdminTransactionsController::createReference($user->id);
        $new_balance =  AccountBalanceController::currentBalance($user);              // KK20210720
        //    print_r("New Bal  1");
        //    print_r($new_balance);
        //    print_r("Amt  1");
        //    print_r($request->amount);
           $new_balance =  $new_balance - $request->amount;                              // KK20210720
        //    print_r("New Bal 2");
        //    print_r($new_balance);  die;  
        $new_balance_update =  AccountBalanceController::debit($user, $request->amount);  // KK20210720
        // $new_balance =  AccountBalanceController::debit($user, $request->amount);  // KK20210720
   
        $reference_admin = AdminTransactionsController::createReference($admin->id);
        $new_balance_admin =  AccountBalanceController::credit($admin, $request->amount);

        $transaction = Transaction::create([
            'user_id'       => $user->id,
            'description'   => $auction->company_name . ' Investment',
            'amount'        => $request->amount,
            'type'          => Transaction::DEBIT,
            'reference'     => $reference,
            'confirmed'     => 1,
            'auction_id'    => $auction->id,
            'status'        =>'Complete',
            'remarks'       =>'Investment',
            'new_balance'   => $new_balance
        ]);

        $transaction = Transaction::create([
            'user_id'       => $admin->id,
            'description'   => $auction->company_name . ' Investment',
            'amount'        => $request->amount,
            'type'          => Transaction::CREDIT,
            'reference'     => $reference_admin,
            'confirmed'     => 1,
            'auction_id'    => $auction->id,
            'status'        =>'Complete',
            'remarks'       =>'Investment',
            'new_balance'   => $new_balance_admin
        ]);

            $id = $auction->id;
            
            $auction = Auction::with(['bids', 'user', 'seller'])->find($id);

            $bids = $auction->bids()->with('investor')
                ->orderBy('bid_discount', 'asc')
                ->orderBy('amount','desc')
                ->orderBy('created_at','asc')
                ->get();
             
            $po = 0;
            $bid_profit = Bid::where('auction_id',$id)->get();
            $bid_amount = $auction->getBidAmountTotal($id);
            $total_bid_amount = $bid_amount[0]->total_bid;
            if(empty($total_bid_amount)){
                $total_bid_amount = 0;
            }
            if(count($bid_profit) != 0){
                $after_bid_total = $auction->getBidAmountTotal($id);
                foreach ($bid_profit as $key => $value_bid_p) {
                        $get_po_value[] = $value_bid_p->getValueOfPoAttribute();
                }
                $po = array_sum($get_po_value);
                foreach ($after_bid_total as $key => $value_after_bid) {
                     $after_total_amount   = $value_after_bid->total_bid;
                }
            }

            if(count($bid_profit) == 0){
                $roi_d                = $auction->getBeforeBidROI();
                $roi                  = number_format((float)$roi_d, 2, '.', '');
                $maximum_discount     = $auction->maximum_discount_limit;
                $po_value             = $auction->total_amount_of_po;
                $d_roi                = $roi;   
                $pound_value          = $roi * 1000 / 100;
                $current_bid_amounts = 0;
                //print_r($pound_value);die;
            }elseif($po > $auction->amount_funding_required){
                $sum = 0;
                foreach ($bids as $key => $value_bid){
                       $current_roi[] = $value_bid->roi;
                       $current_bid_amount[] = $value_bid->amount;
                       $current_profit[] = $value_bid->getProfitAttribute();
                       $sum+= $value_bid->getValueOfPoAttribute();
                       $list_po_value[] = $value_bid->getValueOfPoAttribute();
                       if($sum > $auction->amount_funding_required)
                       {
                            break;
                       }
                }

                function update_last(&$array, $value){
                    array_pop($array);
                    array_push($array, $value);     
                }

                $removed = array_pop($list_po_value);
                $partial_value = $auction->amount_funding_required - array_sum($list_po_value);

                array_push($list_po_value,$partial_value);

                $user_roi           = end($current_roi);
                $user_po_value      = $partial_value;
                $current_bid_amounts = array_sum($current_bid_amount);
                $user_bid_amount    = round($user_po_value / (1 + $user_roi/100));
                update_last($current_bid_amount,$user_bid_amount);
                update_last($current_profit,$user_bid_amount);
                $total_bid_amount   = array_sum($current_bid_amount);

               
                $po_value           = array_sum($list_po_value);
                $user_profit        = $user_po_value - $user_bid_amount;
                $user_share_of_po   = round($user_po_value / $auction->total_amount_of_po);
                $current_main_roi_d = ($po_value - $total_bid_amount) * 100 / $total_bid_amount;
                $current_main_roi   = number_format((float)$current_main_roi_d, 2, '.', '');
                $roi                = $current_main_roi;
                $d_roi              = $current_main_roi;
                $pound_value        = $d_roi * $total_bid_amount / 100;
                $po_value           = $auction->total_amount_of_po;
                $maximum_discount_d = (( ($current_main_roi) / 100  )  / ( 1 + ($current_main_roi) / 100  ) * 100 ) ;
                $maximum_discount       = number_format((float)$maximum_discount_d, 2, '.', '');
            }else{
                $total_amount           = $auction->getBidAmountTotal($id);
                foreach ($total_amount as $key => $value_amount) {
                    $total_bid_amount   = $value_amount->total_bid;
                }
                foreach ($bid_profit as $key => $value_bid_p) {
                    $profit[]           = $value_bid_p->getProfitAttribute();
                }
                $total_profit           = array_sum($profit);
                $decimal_roi            = $auction->getBeforeBidROI();
                $d_roi                  = number_format((float)$decimal_roi, 2, '.', '');
                //$roi_d                  = $auction->maximum_discount_limit / 1 - $auction->maximum_discount_limit / 100;
                $roi_d                  = $total_profit / $total_bid_amount * 100;
                $pound_value            = $roi_d * $total_bid_amount / 100;
                $roi                    = number_format((float)$roi_d, 2, '.', '');
                $po_value               = $auction->total_amount_of_po;
                $maximum_discount_d     = $roi / ( 1 + $roi / 100);
                $maximum_discount       = number_format((float)$maximum_discount_d, 2, '.', '');
                $current_bid_amounts    = $total_bid_amount;
            }

            $bid_data_length = count($bids);
            $array_approved_bids = array();
            if($bid_data_length != 0){
                $i = 0;
                $k = 0;
                
                $step_wise_po_total = 0;
                $stepwise_bid_amount = 0;
                $stepwise_roi = 0;
                $stepwise_po_value = 0;
                $decline_bids_reached = 0;

                for($i = 0; $i < $bid_data_length; $i++){
                    if($decline_bids_reached == 0){
                        
                        $stepwise_bid_amount    = $bids[$i]['amount'];
                        $stepwise_roi           = $bids[$i]['bid_discount'];
                        $stepwise_po_value      = floor($stepwise_bid_amount * (1 + $stepwise_roi / 100)); 
                        $step_wise_po_total     = $step_wise_po_total + $stepwise_po_value;

                        if($step_wise_po_total <= $auction->amount_funding_required){
                            $array_approved_bids[$k]['bid_id']          = $bids[$i];
                            $array_approved_bids[$k]['amount']          = $bids[$i]->amount;
                            $array_approved_bids[$k]['roi']             =   $bids[$i]->bid_discount;
                            $array_approved_bids[$k]['is_accepted']     = 1;
                        }else{
                            $decline_bids_reached = 1;

                            $declined_po_factor = $step_wise_po_total - $auction->amount_funding_required;
                            $approved_po_factor = $stepwise_po_value - $declined_po_factor;

                            $approved_bid_amount = floor($approved_po_factor / (1 + $stepwise_roi / 100));
                            $declined_bid_amount = $stepwise_bid_amount - $approved_bid_amount;

                            //partially approved bids
                            $array_approved_bids[$k]['bid_id']          = $bids[$i];
                            $array_approved_bids[$k]['amount']          = $approved_bid_amount;
                            $array_approved_bids[$k]['roi']             = $stepwise_roi;
                            $array_approved_bids[$k]['is_accepted']     = 1;
                            $array_approved_bids[$k]['partially']       = 1;

                            $investorUser   = User::find($bids[$i]->user_id);
                            $not_title = 'Bid Partially Accepted';
                            $not_body = 'Your Bid for auction #'.$id.' is Partially Accepted. ';
                            $not_link  = route('auction.details',$id);
                            $notification = new UserNotification($not_title,$not_body,$not_link);
                            NotificationsController::sendToUser($investorUser,$notification);
                            
                            $k++;
                            $array_approved_bids[$k]['bid_id']          = $bids[$i];
                            $array_approved_bids[$k]['amount']          = $declined_bid_amount;
                            $array_approved_bids[$k]['roi']             = $stepwise_roi;
                            $array_approved_bids[$k]['is_accepted']     = 0;
                        }
                        $k++;
                    }else{
                        $array_approved_bids[$k]['bid_id']          =  $bids[$i];
                        $array_approved_bids[$k]['amount']          =  $bids[$i]->amount;
                        $array_approved_bids[$k]['roi']             =  $bids[$i]->bid_discount;
                        $array_approved_bids[$k]['is_accepted']     = 0;
                        $k++;

                        $investorUser   = User::find($bids[$i]->user_id);
                        $not_title = 'Bid rejected';
                        $not_body = 'Your Bid for auction #'.$id.' is rejected. ';
                        $not_link  = route('auction.details',$id);
                        $notification = new UserNotification($not_title,$not_body,$not_link);
                        NotificationsController::sendToUser($investorUser,$notification);
                    }
                }
            }

            $accepted_id = array();
            $rank = 1;

            if($auction->amount_funding_required == $request->amount){
                foreach ($array_approved_bids as $key_approve => $value_approve) {
                    if($value_approve['is_accepted'] == 1){
                        if(!in_array($value_approve['bid_id']->id, $accepted_id)){
                            array_push($accepted_id, $value_approve['bid_id']->id);
                            $bid = Bid::find($value_approve['bid_id']->id);
                            $bid->accepted_amount = $value_approve['amount'];
                            $bid->rank = $rank;
                            $bid->save();
                        }
                    }else{
                        if(!in_array($value_approve['bid_id']->id, $accepted_id)){
                            array_push($accepted_id, $value_approve['bid_id']->id);
                            $bid = Bid::find($value_approve['bid_id']->id);
                            $bid->accepted_amount = 0;
                            $bid->rank = $rank;
                            $bid->save();
                        }
                    }
                    $rank++;
                }
            } 

        return redirect()->back()->with('msg', 'Your Investment Bid has been placed.');
    }


    public function editBid(Request $request, $id)
    {
        $auction = Auction::findOrFail($id);

        $user = Auth::user();

        if($request->amount >0 ){

            $reference = AdminTransactionsController::createReference($user->id);
            $new_balance =  AccountBalanceController::currentBalance($user);
            $bid = $auction->loggedInInvestorBid();
            $old_bid = $bid->amount;
            $old_bid_discount = $bid->bid_discount;

            $new_bid = $request->amount;

            $new_discount =  $request->bid_discount;

            $new_roi_in_pound = $request->roi_pound;

            $diff = abs($new_bid - $old_bid);

            /*if ($new_bid < $old_bid) {
               AccountBalanceController::credit($user,$diff);
               $new_balance = $new_balance + $diff;
            }
            if ($new_bid > $old_bid) {
                
            }*/

             //if the bid discount is bigger than the old big discount update
// dd($user->balance_amount);
            if($new_bid <= ($user->balance_amount + $old_bid)){
                if($new_bid >= $old_bid)
                    $bid->update($request->all());
                else
                    return redirect()->back()->with('msg', "Your bid needs to be more competitive than you last bid");

                // if($new_discount >= $old_bid_discount)
                //     $bid->update($request->all());
                // else
                //     return redirect()->back()->with('msg', "Your bid discount needs to be more competitive than you last bid");

                AccountBalanceController::debit($user,$diff);
                $new_balance = $new_balance - $diff;
                $transaction = Transaction::create([
                                        'user_id'       => $user->id,
                                        'description'   => $auction->company_name . ' Investment',
                                        'amount'        => $diff,
                                        'type'          => Transaction::DEBIT,
                                        'reference'     => $reference,
                                        'confirmed'     => 1,
                                        'auction_id'    => $auction->id,
                                        'status'        =>'Complete',
                                        'remarks'       =>'Investment',
                                        'new_balance'   => $new_balance
                                    ]);
                $this->sendOutBidNotification($auction, $request);
                $this->sendNotificationToSeller($auction);

                return redirect()->back()->with('msg', 'Your Investment Bid has been updated.');
            }else
                return redirect()->back()->with('msg', "Cannot update your bid more thant your current account (£ {$user->balance_amount} )");
        }
        else
            return redirect()->back()->with('msg', 'Please enter a bid greater than zero!');

    }


    public function sendOutBidNotification(Auction $auction, $request)
    {

        $user = Auth::user();
        $investors_IDs = $auction->bids->where('bid_discount', '>', $request->bid_discount)
            ->where('amount', '<', $request->amount)
            ->where('user_id', '!=', $user->id)->pluck('user_id')->toArray();
        $link = route('auction.details', $auction->id);
        $notification = new UserNotification('Outbid', 'You have been outbid for auction : ' . optional($auction->seller)->company_name, $link);

        NotificationsController::sendToUsers($investors_IDs, $notification);
    }

    public function sendNotificationToSeller(Auction $auction){
        $user = User::findOrFail($auction->user_id);

        $not_title = config('notifications.seller.auction_bid');
        $not_body = "Your auction ( $auction->company_name ) has received a bid";
        $not_link = route('auction.details',['id'=>$auction->id]);
        $notification = new UserNotification($not_title,$not_body,$not_link);

        NotificationsController::sendToUser($user,$notification);
    }

    public function sendNotificationToSellerForAuctionEnd(Auction $auction){
        $user = User::findOrFail($auction->user_id);

        $not_title = config('notifications.seller.auction_ended_bid');
        $not_body = "Your auction #$auction->id has come to end, please upload the invoice by ".date('d/m/Y',strtotime($auction->expected_invoice_issue_date));
        $not_link = route('auction.details',['id'=>$auction->id]);
        $notification = new UserNotification($not_title,$not_body,$not_link);

        NotificationsController::sendToUser($user,$notification);

        $not_title = 'Auction Ends';
        $not_link  = route('auction.details',$auction->id);
        $not_body = 'Auction #'.$auction->id.' has come to end ';
        
        $notification = new AdminNotification($not_title, $not_body, $not_link);
        NotificationsController::sendToAdmins($notification);
    }



}
