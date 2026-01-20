<?php

namespace App\Http\Controllers;

use App\Helpers\WinningBids;
use App\Http\Controllers\Search\AuctionsSearch;
use App\Model\Admin\AdminSettings;
use App\Model\Auction\Auction;
use App\Model\Auction\Invoice;
use Illuminate\Http\Request;
use App\Model\Bid;
use App\Model\Buyer\BuyerTransaction;
use DB;
use Auth;


class MarketplaceController extends Controller
{

    public static function update_lastest(&$array, $value){
        array_pop($array);
        array_push($array, $value);     
    }


    public function index(Request $request)
    {

        $request = Request::capture();
        $auction_status = request()->AuctionStatus;
        if(isset(request()->SortBy)){
            $SortBy = request()->SortBy;
            if($SortBy == 'oldest')$sort_by = 'ASC';
            elseif($SortBy == 'recent')$sort_by = 'DESC';
        }else{
            $sort_by = 'DESC';   
        }
        if ( $auction_status != null  )
        {   
            if($auction_status == "Live"){
                $auctions = Auction::where('approved',1)->where('status','!=','Ended')->orderBy('id',$sort_by)->get();
            }elseif($auction_status=="unsuccessfull"){
                $d=date('Y-m-d');
                $auctions = Auction::where('approved','1')->where('end_auction','<',$d)->get();                
                // $auctions = Auction::where('approved','1')->with('bids')->get();

                $failed = array();

                foreach ($auctions as $auction){

                    $totalBids = 0;

                    foreach ($auction->bids()->get() as $bid){

                        $totalBids =+ $bid->amount;
                    }

                    if($totalBids !== $auction->amount_funding_required){
                        $failed[]=$auction->id;
                    }
                }
                $auctions = Auction::whereIn('id',$failed)->get();
            }else{
                if($auction_status == 'Complete')$auction_status = 'Ended';
                $auctions = Auction::where('approved',1)->where('status',$auction_status)->orderBy('id',$sort_by)->get();
            }
        }
        else
        {
            $auctions = Auction::where('approved',1)->orderBy('id',$sort_by)->get();
        }
        //$auctions = AuctionsSearch::apply($request);

        $all  ="all";  
        $live  ="live";  
        $complete  ="complete"; 
        return view('marketplace.index', compact('auctions','all','live','complete','auction_status'));
        // return view('marketplace.index', compact('auctions','all','live','complete','update_lastest','auction_status'));
    }

   
    /**
     * Show auction details view
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAuction(Request $request,$id)
    {
        $current_user_id = auth()->user()->id;
        $auction = Auction::with(['bids', 'user', 'seller'])->find($id);
        // /*print_r('<pre>');
        // print("<pre>".print_r($auction->funding_success,true)."</pre>");
        // print_r($auction);

        // exit;*/
        if($auction==null){
            abort(404);
        }
        $buyer_transaction = BuyerTransaction::where('auction_id',$id)->get();
        
        // KK Added 20210721
        // $bids = $auction->bids()->with('investor')
        //     ->orderBy('bid_discount', 'asc')
        //     ->orderBy('amount','desc')
        //     ->orderBy('created_at','asc')
        //     ->get();
         
        $bids = $auction->bids()->with('investor')
            ->orderBy('amount','desc')    
            ->orderBy('bid_discount', 'asc')
            ->orderBy('created_at','asc')
            ->get();
            // print("<pre>".print_r($bids,true)."</pre>");
        // End of KK Added 20210721
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
//      If no bids made so far....
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
//      If the amounts bid so far, exceed the amount that was required
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

            function update_last(&$array, $value){
                array_pop($array);
                array_push($array, $value);     
            }

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
        // else accept a bid
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

        // $max_roi    = ($auction->maximum_discount_limit) / (1 - ($auction->maximum_discount_limit/100));
        $max_roi    = $auction->maximum_discount_limit;
        $max_roi_f  = number_format((float)$max_roi, 2, '.', '');
        $invoice    = new invoice();
        $settings   = AdminSettings::first();

         $bid_last = $auction->bids()->with('investor')
            ->orderBy('roi', 'asc')
            ->orderBy('amount','desc')
            ->orderBy('created_at','asc')
            ->get()->last();
         $bid_last_amount = $bid_last['amount'];
         $bid_last_roi    = $bid_last['bid_discount'];

        // $bid_info = $auction->bids()->with('investor')
        //     ->orderBy('bid_discount', 'asc')
        //     ->orderBy('amount','desc')
        //     ->orderBy('created_at','asc')
        //     ->get()
        //     ->toArray();
        
        //$bid_data_roi = array_reverse($bid_info); 
        $bid_data_roi = array();
        $bid_info_r = $auction->bids()->with('investor')
        	->where('user_id','!=',$current_user_id)
            ->orderBy('bid_discount', 'asc')
            ->orderBy('amount','desc')
            ->orderBy('created_at','asc')
            ->get()
            ->toArray();

        $bid_data_roi_r = array_reverse($bid_info_r); 

        $edit_bid_amount = Bid::where('auction_id',$id)->where('user_id','!=',$current_user_id)->sum('amount');
     
        $bid_data_length = count($bids);
        
        $array_approved_bids = array();
        $investedInBid = 0;
        $accepted_po = 0;
        $accepted_bid_only = array();
        $accepted_bid_amount = 0;

        if($bid_data_length != 0)
        {
            $i = 0;
            $k = 0;

            $step_wise_po_total = 0;
            $stepwise_bid_amount = 0;
            $stepwise_roi = 0;
            $stepwise_po_value = 0;
            $decline_bids_reached = 0;
            
            
            $array_declined_bids;

            for($i = 0; $i < $bid_data_length; $i++)
            {

                if($decline_bids_reached == 0)
                {
                    $stepwise_bid_amount    = $bids[$i]['amount'];
                    $stepwise_roi           = $bids[$i]['bid_discount'];
                    // $stepwise_po_value      = floor($stepwise_bid_amount * (1 + $stepwise_roi / 100));    //KK20210810
                    $stepwise_po_value      = floor($stepwise_bid_amount);                                  //KK20210810
                    $step_wise_po_total     = $step_wise_po_total + $stepwise_po_value;

                    $accepted_bid_only[$i]['amount'] = $bids[$i]->amount;
                    $accepted_bid_only[$i]['bid_discount'] = $bids[$i]->bid_discount;
                    $accepted_bid_only[$i]['roi'] = $bids[$i]->roi;
                    $accepted_bid_only[$i]['roi_in_pound'] = $bids[$i]->roi_in_pound;

                    $accepted_po = $accepted_po + $stepwise_po_value;

                    if($step_wise_po_total <= $auction->amount_funding_required)
                    {
                        $array_approved_bids[$k]['bid_id']          = $bids[$i];
                        $array_approved_bids[$k]['amount']          = $bids[$i]->amount;
                        $array_approved_bids[$k]['roi']             = $bids[$i]->bid_discount;
                        $array_approved_bids[$k]['roi_in_pound']    = $bids[$i]->roi_in_pound;   // KK20210720
                        $array_approved_bids[$k]['is_accepted']     = 1;
                        if(auth()->user()->id == $bids[$i]->user_id){
                            $investedInBid = 1;
                        }
                        $accepted_bid_amount = $accepted_bid_amount + $bids[$i]->amount;

                    }
                    else
                    {
                 
                        $decline_bids_reached = 1;

                        $declined_po_factor = $step_wise_po_total - $auction->amount_funding_required;
                        $approved_po_factor = $stepwise_po_value - $declined_po_factor;
                        
                        // print("<pre>".print_r($array_approved_bids,true)."</pre>");
                        // print("<pre>".print_r($auction->amount_funding_required,true)."</pre>");
                        // print("<pre>".print_r($stepwise_po_value,true)."</pre>");     
                        // print("<pre>".print_r($declined_po_factor,true)."</pre>");  

                        // $approved_bid_amount = floor($approved_po_factor / (1 + $stepwise_roi / 100));   //KK20210811
                        $approved_bid_amount = $approved_po_factor;                                         //KK20210811
                        $declined_bid_amount = $stepwise_bid_amount - $approved_bid_amount;

                        if($approved_bid_amount > 0){
                            //partially approved bids
                            $array_approved_bids[$k]['bid_id']          = $bids[$i];
                            $array_approved_bids[$k]['amount']          = $approved_bid_amount;
                            $array_approved_bids[$k]['roi']             = $stepwise_roi;
                            $array_approved_bids[$k]['roi_in_pound']    = $bids[$i]->roi_in_pound;   // KK20210720 Calculation to be checked
                            $array_approved_bids[$k]['is_accepted']     = 1;

                            if(auth()->user()->id == $bids[$i]->user_id){
                                $investedInBid = 1;
                            }
                            $accepted_bid_amount = $accepted_bid_amount + $approved_bid_amount;
                            
                            $k++;
                        }
                        
                        
                        $array_approved_bids[$k]['bid_id']          = $bids[$i];
                        $array_approved_bids[$k]['amount']          = $declined_bid_amount;
                        $array_approved_bids[$k]['roi']             = $stepwise_roi;
                        $array_approved_bids[$k]['roi_in_pound']    = $bids[$i]->roi_in_pound;   // KK20210720 Calculation to be checked
                        $array_approved_bids[$k]['is_accepted']     = 0;

                    }

                    $k++;
                }
                else
                {
                    $array_approved_bids[$k]['bid_id']          =  $bids[$i];
                    $array_approved_bids[$k]['amount']          =  $bids[$i]->amount;
                    $array_approved_bids[$k]['roi']             =  $bids[$i]->bid_discount;
                    $array_approved_bids[$k]['roi_in_pound']    =  $bids[$i]->roi_in_pound;   // KK20210720
                    $array_approved_bids[$k]['is_accepted']     = 0;
                    $k++;

                }
            }
            
            $bid_data_roi = array_reverse($accepted_bid_only); 
            foreach ($array_approved_bids as $key => $value) {
                // Begin of KK20210720
                // if($value['roi'] > 0 )
                // {
                //     $po_value_list =  $value['amount'] * (1 + ( $value['roi'] / 100)) ;
                // }
                // if($value['roi'] == 0){
                //     $po_value_list = $value['amount'];
                $po_value_list = $value['amount'];
                // print("<pre>".print_r($value,true)."</pre>"); die;
                // }      
                // End of KK20210720
                // print_r($value['roi']); print_r($value['amount']);print_r($po_value_list);
                // print_r($value);die;
                //OLD calculation
                //$share_of_po_list =  $po_value_list / $po * 100;
                
                // $share_of_po_list =  $po_value_list * 100 / $auction->amount_funding_required; KK20210720
                $share_of_po_list =  ($po_value_list / $auction->total_amount_of_po) * 100; // KK20210720

                $share_of_po =  number_format((float)$share_of_po_list, 2, '.', '');

                // $profit  = $po_value_list - $value['amount']; KK20210720
                $profit  = $value['roi_in_pound']; // KK20210720

                if($value['roi'] == 0){
                    $profit = 0;
                }
                
        
                $array_approved_bids[$key]['value_of_po'] = $po_value_list;
                $array_approved_bids[$key]['share_of_po'] = $share_of_po;
                $array_approved_bids[$key]['profit']      = $profit;
            }
            
            $flag = 1;    
        }else{
            $flag = 0;
        }
        //,'bid_array_data','edit_bid_data',
        //$winners = json_decode(json_encode(WinningBids::getResults($id)));
        // print("<pre>".print_r($auction->funding_joint_fee,true)."</pre>");
        return view('marketplace.auction_details', compact(['auction','maximum_discount','po_value','accepted_po','accepted_bid_amount','bids', 'roi','d_roi','invoice','settings','po','max_roi_f','total_bid_amount','pound_value','bid_last_amount','bid_last_roi','current_bid_amounts','array_approved_bids','flag','edit_bid_amount','investedInBid','buyer_transaction']))->with(['bid_data'=> 'bid_data_roi','edit_bid_data'=>'bid_data_roi_r']);
    }

  
    public function rankingAuction(Request $request,$id){

        $auction = Auction::with(['bids', 'user', 'seller'])->find($id);
        if($auction==null){
            abort(404);
        }
        $request = Request::capture();
        $bids = $auction->bids()->with('investor')
            ->where('user_id','!=',$request->user_id)
            ->orderBy('roi', 'asc')
            ->orderBy('amount','desc')
            ->orderBy('created_at','asc')
            ->get()
            ->toArray();

        if(!empty($bids))
        { 
            foreach ($bids as $key => $value) {  

                    $keys =  $key + 2;  
                    if($value['roi'] >= $request->roi)
                    {
                        if($value['roi'] == $request->roi){  
                            if($request->bid_amount  >= $value['amount']){ 
                                if($request->bid_amount  > $value['amount']){
                                    return $keys = $key + 1;
                                    break;
                                } 
                            }

                        } else { 
                            return $keys = $key + 1; 
                            break;
                        }
                    } elseif(($value['roi'] < $request->roi) && ( @$bids[$key+1]['roi'] > $request->roi) && isset($bids[$key+1]))  { 
                        return $key + 2;
                    } 

                }
                return $keys;
        } else {
            return 1;
        }
    }
}
