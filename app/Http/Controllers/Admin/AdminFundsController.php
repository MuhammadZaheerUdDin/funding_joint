<?php
namespace App\Http\Controllers\Admin;
/**
 * Created by PhpStorm.
 * User: gmoulton
 * Date: 09/11/2018
 * Time: 11:19
 * get funding amount minus expenses
 * send amount to seller
 * keep winning bidders money
 * refund bids from non winners complete
 */

use App\Model\Auction\Auction;
use App\Notifications\UserNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use App\Helpers\WinningBids;
use App\Model\Bid;
use App\Model\Transaction;
use App\Model\Users\User;
use App\Http\Controllers\Admin\NotificationsController;
use App\Notifications\AdminNotification;


/**
 * Class AdminFundsController
 * @package App\Http\Controllers\Admin
 */
class AdminFundsController
{

    /**
     * This function will release funds to the seller
     * @method releaseFunds
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function releaseFunds($id) {

        $details = WinningBids::transferAmountToSeller($id);

        return response()->json([
            'auctionTotalAchieved' => $details['auctionTotalAchieved'],
            'investorsCut' => $details['investorsCut'],
            'fjFee' => $details['fjFee'],
            'totalPayout' => $details['totalPayout']
        ]);

    }

    public function endAuction() {

        $current_date = date('Y-m-d');

        $auctions = Auction::where('approved',1)->where('status','=','Live')->where('end_auction','=',$current_date)->get();

        function update_last(&$array, $value){
            array_pop($array);
            array_push($array, $value);     
        }

        foreach ($auctions as $key => $value) {
            $id = $value->id;
            
            $auction = Auction::with(['bids', 'user', 'seller'])->find($id);

            $auction->status = 'Ended';
            //$auction->status = 'Live';
            $auction->save();

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
            if(count($bid_profit) != 0)
            {
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
            }
            elseif($po > $auction->amount_funding_required){
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
            }
            else{
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
            if($bid_data_length != 0)
            {
                $i = 0;
                $k = 0;
                
                $step_wise_po_total = 0;
                $stepwise_bid_amount = 0;
                $stepwise_roi = 0;
                $stepwise_po_value = 0;
                $decline_bids_reached = 0;

                

                for($i = 0; $i < $bid_data_length; $i++)
                {

                    if($decline_bids_reached == 0)
                    {
                        $stepwise_bid_amount    = $bids[$i]['amount'];
                        $stepwise_roi           = $bids[$i]['bid_discount'];
                        $stepwise_po_value      = floor($stepwise_bid_amount * (1 + $stepwise_roi / 100)); 
                        $step_wise_po_total     = $step_wise_po_total + $stepwise_po_value;

                        if($step_wise_po_total <= $auction->amount_funding_required)
                        {
                            $array_approved_bids[$k]['bid_id']          = $bids[$i];
                            $array_approved_bids[$k]['amount']          = $bids[$i]->amount;
                            $array_approved_bids[$k]['roi']             =   $bids[$i]->bid_discount;
                            $array_approved_bids[$k]['is_accepted']     = 1;
                        }
                        else
                        {
                            
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
                            
                            $k++;
                            $array_approved_bids[$k]['bid_id']          = $bids[$i];
                            $array_approved_bids[$k]['amount']          = $declined_bid_amount;
                            $array_approved_bids[$k]['roi']             = $stepwise_roi;
                            $array_approved_bids[$k]['is_accepted']     = 0;

                        }
                        $k++;
                    }
                    else
                    {
                        $array_approved_bids[$k]['bid_id']          =  $bids[$i];
                        $array_approved_bids[$k]['amount']          =  $bids[$i]->amount;
                        $array_approved_bids[$k]['roi']             =  $bids[$i]->bid_discount;
                        $array_approved_bids[$k]['is_accepted']     = 0;
                        $k++;
                    }
                }
            }
            $accepted_id = array();
            $rank = 1;

            
            foreach ($array_approved_bids as $key_approve => $value_approve) {
                if($value_approve['is_accepted'] == 1){
                    if(!in_array($value_approve['bid_id']->id, $accepted_id)){
                        array_push($accepted_id, $value_approve['bid_id']->id);
                        $bid = Bid::find($value_approve['bid_id']->id);
                        $bid->accepted_amount = $value_approve['amount'];
                        $bid->rank = $rank;
                        $bid->save();
                        
                        if(isset($value_approve['partially']) && $value_approve['partially'] == 1){
                            $investorUser   = User::find($bid->user_id);
                            $not_title = 'Bid Partially Accepted';
                            $not_body = 'Your Bid for auction #'.$value->id.' is Partially Accepted. ';
                            $not_link  = route('auction.details',$value->id);
                            $notification = new UserNotification($not_title,$not_body,$not_link);
                            NotificationsController::sendToUser($investorUser,$notification);
                        }else{
                            $investorUser   = User::find($bid->user_id);
                            $not_title = 'Bid Accepted';
                            $not_body = 'Your Bid for auction #'.$value->id.' is Accepted. ';
                            $not_link  = route('auction.details',$value->id);
                            $notification = new UserNotification($not_title,$not_body,$not_link);
                            NotificationsController::sendToUser($investorUser,$notification);
                        }
                    }
                }else{
                    if(!in_array($value_approve['bid_id']->id, $accepted_id)){
                        array_push($accepted_id, $value_approve['bid_id']->id);
                        $bid = Bid::find($value_approve['bid_id']->id);
                        $bid->accepted_amount = 0;
                        $bid->rank = $rank;
                        $bid->save();

                        $investorUser   = User::find($bid->user_id);
                        $not_title = 'Bid rejected';
                        $not_body = 'Your Bid for auction #'.$value->id.' is rejected. ';
                        $not_link  = route('auction.details',$value->id);
                        $notification = new UserNotification($not_title,$not_body,$not_link);
                        NotificationsController::sendToUser($investorUser,$notification);
                    }
                }
                $rank++;
            }
            
            $sellerUser   = User::find($value->user_id);
            
            $not_title = 'Auction Ends';
            $not_body = 'Your Auction #'.$value->id.' has come to end. Please upload invoice. ';
            $not_link  = route('auction.details',$value->id);
            $notification = new UserNotification($not_title,$not_body,$not_link);
            NotificationsController::sendToUser($sellerUser,$notification);

            $not_title = 'Auction Ends';
            $not_link  = route('auction.details',$value->id);
            $not_body = 'Auction #'.$value->id.' has come to end ';
            
            $notification = new AdminNotification($not_title, $not_body, $not_link);
            NotificationsController::sendToAdmins($notification);
            
        }

    }

    public function releaseFundsToAllUnacceptedBid() {
        $current_date = date('Y-m-d');

        $auctions = Auction::where('approved',1)->where('status','=','Ended')->where('is_transferred','=',0)->where('end_auction','=',$current_date)->get();
        
        function update_last(&$array, $value){
            array_pop($array);
            array_push($array, $value);     
        }
        
        foreach ($auctions as $key => $value) {
            $id = $value->id;
            $auction = Auction::with(['bids', 'user', 'seller'])->find($id);
            $auction->is_transferred = 1;
            $auction->save();

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
            if(count($bid_profit) != 0)
            {
                $after_bid_total = $auction->getBidAmountTotal($id);
                foreach ($bid_profit as $key => $value) {
                        $get_po_value[] = $value->getValueOfPoAttribute();
                }
                $po = array_sum($get_po_value);
                foreach ($after_bid_total as $key => $value) {
                     $after_total_amount   = $value->total_bid;
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
            }
            elseif($po > $auction->amount_funding_required){
                $sum = 0;
                foreach ($bids as $key => $value){
                       $current_roi[] = $value->roi;
                       $current_bid_amount[] = $value->amount;
                       $current_profit[] = $value->getProfitAttribute();
                       $sum+= $value->getValueOfPoAttribute();
                       $list_po_value[] = $value->getValueOfPoAttribute();
                       if($sum > $auction->amount_funding_required)
                       {
                            break;
                       }
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
            }
            else{
                $total_amount           = $auction->getBidAmountTotal($id);
                foreach ($total_amount as $key => $value) {
                    $total_bid_amount   = $value->total_bid;
                }
                foreach ($bid_profit as $key => $value) {
                    $profit[]           = $value->getProfitAttribute();

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

            if($bid_data_length != 0)
            {
                $i = 0;
                $k = 0;
                $j = 0;

                $step_wise_po_total = 0;
                $stepwise_bid_amount = 0;
                $stepwise_roi = 0;
                $stepwise_po_value = 0;
                $decline_bids_reached = 0;

                $array_approved_bids;
                $array_declined_bids;

                for($i = 0; $i < $bid_data_length; $i++)
                {

                    if($decline_bids_reached == 0)
                    {
                        $stepwise_bid_amount    = $bids[$i]['amount'];
                        $stepwise_roi           = $bids[$i]['bid_discount'];
                        $stepwise_po_value      = floor($stepwise_bid_amount * (1 + $stepwise_roi / 100)); 
                        $step_wise_po_total     = $step_wise_po_total + $stepwise_po_value;

                        if($step_wise_po_total <= $auction->amount_funding_required)
                        {
                            $array_approved_bids[$k]['bid_id']          = $bids[$i];
                            $array_approved_bids[$k]['amount']          = $bids[$i]->amount;
                            $array_approved_bids[$k]['roi']             =   $bids[$i]->bid_discount;
                            $array_approved_bids[$k]['is_accepted']     = 1;
                        }
                        else
                        {
                            
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
                            
                            $k++;
                            $array_approved_bids[$k]['bid_id']          = $bids[$i];
                            $array_approved_bids[$k]['amount']          = $declined_bid_amount;
                            $array_approved_bids[$k]['roi']             = $stepwise_roi;
                            $array_approved_bids[$k]['is_accepted']     = 0;

                            $array_declined_bids[$j]['investor_id']     = $bids[$i]->user_id;
                            $array_declined_bids[$j]['amount']          = $declined_bid_amount;
                            $array_declined_bids[$j]['auction_id']      = $id;
                            $j++;
                        }

                        $k++;
                    }
                    else
                    {
                        $array_approved_bids[$k]['bid_id']          =  $bids[$i];
                        $array_approved_bids[$k]['amount']          =  $bids[$i]->amount;
                        $array_approved_bids[$k]['roi']             =  $bids[$i]->bid_discount;
                        $array_approved_bids[$k]['is_accepted']     = 0;
                        $k++;

                        $array_declined_bids[$j]['investor_id']     = $bids[$i]->user_id;
                        $array_declined_bids[$j]['amount']          = $bids[$i]->amount;
                        $array_declined_bids[$j]['auction_id']      = $id;
                        $j++;
                       
                    }
                }
            }
            
            foreach ($array_declined_bids as $key => $value) {
                $investor_id = $value['investor_id'];
                $auction_id = $value['auction_id'];

                $investorUser   = User::find($investor_id);
                $adminUser   = User::find(1);
                $auction        = Auction::find($auction_id);

                $bid            = Bid::where('user_id', $investor_id)->where('auction_id', $auction_id)->first();
                $amount         = $value['amount'] ;
                //Creating a new transaction reference
                $reference      =  AdminTransactionsController::createReference($investorUser->id).'_'.rand(1000,3);
                $reference_admin      =  AdminTransactionsController::createReference($adminUser->id).'_'.rand(1000,3);
                
                //change investor's balance
                $investorUser->balance->update([
                    'balance' => $investorUser->balance->balance += $amount
                ]);

                $adminUser->balance->update([
                    'balance' => $adminUser->balance->balance -= $amount
                ]);

                //create new transaction for the payment
                $transaction    = Transaction::create([
                    'reference' =>$reference,
                    'amount'    => $amount,
                    'user_id'   =>$investorUser->id,
                    'type'      =>Transaction::CREDIT,
                    'description'=>"Investment refunded: ". $auction->buyer->company_name . ", Auction # ".$auction_id,
                    'status'    =>'Complete',
                    'remarks'       =>'Investment',
                    'auction_id'=>$auction_id,
                    'confirmed' =>'1',
                    'new_balance' => $investorUser->balance_amount
                ]);

                $transaction    = Transaction::create([
                    'reference' =>$reference_admin,
                    'amount'    => $amount,
                    'user_id'   =>$adminUser->id,
                    'type'      =>Transaction::DEBIT,
                    'description'=>"Investment refunded: ". $auction->buyer->company_name . ", Auction # ".$auction_id,
                    'status'    =>'Complete',
                    'remarks'       =>'Investment',
                    'auction_id'=>$auction_id,
                    'confirmed' =>'1',
                    'new_balance' => $adminUser->balance_amount
                ]);

                $not_title = config('notifications.investor.repayment_received');
                $not_body = 'Admin released your unaccepted bid '. $auction->buyer->company_name . '( '.$auction_id.' )';
                $not_link  = route('auction.details',$auction_id);

                $notification = new UserNotification($not_title,$not_body,$not_link);

                NotificationsController::sendToUser($investorUser,$notification);
            }
            
        }    
    }

}