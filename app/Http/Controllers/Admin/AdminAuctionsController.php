<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\DownloadFile;
use App\Helpers\Exporter;
use App\Helpers\WinningBids;
use App\Http\Controllers\Buyers\BuyersController;
use App\Http\Controllers\Search\AuctionsSearch;
use App\Model\Auction\Auction;
use App\Model\Admin\AdminSettings;
use App\Model\Auction\Invoice;
use App\Model\Buyer\Buyer;
use App\Model\Users\User;
use App\Notifications\AuctionDeclineNotification;
use App\Notifications\AuctionStopNotification;
use Illuminate\Support\Facades\DB;
use App\Notifications\UserNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use App\Model\Bid;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Input;

class AdminAuctionsController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        $auctionsSearch = new AuctionsSearch();

        $auction_status = request()->AuctionStatus;
        $fields = false;
        if($auction_status == 'complete')$auction_status = 'Ended';
        
        //$auctions = Auction::all();
        if(isset(request()->SortBy)){
            $SortBy = request()->SortBy;
            if($SortBy == 'oldest')$sort_by = 'ASC';
            elseif($SortBy == 'recent')$sort_by = 'DESC';
        }else{
            $sort_by = 'DESC';   
        }
        if ( $auction_status != null  )
        {   
            if($auction_status == "live"){
                $auctions = Auction::/*where('approved',1)->*/where('status','!=','Ended')->orderBy('id',$sort_by)->get();
            }else if($auction_status == "all"){
                $auctions = Auction::/*where('approved',1)->*/orderBy('id',$sort_by)->get();
            }else{
                if($auction_status == 'complete')$auction_status = 'Ended';
                $auctions = Auction::/*where('approved',1)->*/where('status',$auction_status)->orderBy('id',$sort_by)->get();
            }
        }
        else
        {
            $auctions = Auction::/*where('approved',1)->*/orderBy('id',$sort_by)->get();
        }
        //$auctions = AuctionsSearch::apply($request);
        $all  ="all";  
        $live  ="live";  
        $complete  ="complete"; 

        if(count($request->all()) > 0){

            $fields = $auctionsSearch->setSearchFields($request->all());

        }
        else
        {

        }


        return view('admin.auctions.index', compact(['auctions', 'fields']));
    }

    public function showAuction($id)
    {   
        $auction = Auction::with(['bids', 'user', 'seller'])->find($id);
        if($auction==null){
            abort(404);
        }
        $bids = $auction->bids()->with('investor')
            ->orderBy('amount', 'desc')
            ->orderBy('bid_discount', 'asc')
            ->get();

        // get the current max discount limit
        $avg_bids = $auction->getAverageBidDiscount($id);

        $invoice = new invoice();
        $settings = AdminSettings::first();
        return view('admin.auctions.auction', compact(['auction', 'bids', 'avg_bids', 'invoice','settings']));
    }


    /**
     * @description Approve an Acution
     * @param $id Auction id
     * @return \Illuminate\Http\JsonResponse
     */
    public function approveAuction($id)
    {
        $auction_end_settings = SettingsController::getMaximumAuctionLength();
        $auction = Auction::findOrFail($id);

        $user = User::where('id',$auction->user_id)->first();

        $ext = $auction->po_file_name;

        $file_name = 'auction-'.$id.'-INV-'.time().$ext;
        $invoice = Invoice::create([
            'user_id'           => $user->id,
            'auction_id'        => $id,
            'invoice_file_name' => $file_name,
            'approved'          => 1
        ]);
        // print("<pre>".print_r($invoice,true)."</pre>");

        if($user->approved == 0){
            return redirect()->back()->withMessage('Please approve the seller profile first.');
        }

        $auction->update([
            'approved' => 1,
            'po_approved' => 1,
            'start_auction' => Carbon::now(),
            'end_auction' => Carbon::now()->addDays($auction_end_settings),
            'status' => 'Live'
        ]);

        $this->approveBuyer($auction);
        $this->sendApproveNotification($auction);

        return redirect()->back()->with('msg', 'Auction has been approved');


    }




    /**
     * @description Decline an Auction
     * @param $id Auction id
     * @return \Illuminate\Http\JsonResponse
     */
    public function declineAuction($id)
    {
        $auction = Auction::findOrFail($id);
        $request = Request::capture();

        $auction->update([
            'approved' => 2,
            'start_auction' => null,
            'end_auction'   => null,
            'status'=>'Declined'
        ]);

        $this->sendDeclineNotification($auction, $request->get('message'));

        return redirect()->back()->with('msg', 'Auction has been declined');

    }

    public function stopAuction($id){
        $auction = Auction::findOrFail($id);

        $request = Request::capture();

        $auction->update([
            'approved' => 3,
            'start_auction' => null,
            'end_auction'   => null,
            'status'=>'Stopped'
        ]);

        $this->sendStopNotification($auction, $request->get('message'));

        return redirect()->back()->with('msg', 'Auction has been stopped');
    }






    /**
     * @description Put an auction to pending
     * @param $id Auction id
     * @return \Illuminate\Http\JsonResponse
     */
    public function pendingAuction($id)
    {
        $auction = Auction::findOrFail($id);

        $request = Request::capture();

        $auction->update([
            'approved' => 0,
            'status'=>'Pending'
        ]);

        $this->sendPendingNotification($auction);

        return redirect()->back()->with('msg', 'Auction has been set to pending');

    }



    /**
     * @method Approve's auction's buyer
     * @param Auction $auction
     * @return boolean
     */
    public function approveBuyer(Auction $auction){
        //Approves buyers
        $buyer = Buyer::findOrFail($auction->buyer->id);
        $buyer_controller = new BuyersController();
        $buyer_controller->onApproveBuyer($buyer->id);

        return $buyer->approved;
    }


    /**
     * @method approvePurchaseOrder
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function approvePurchaseOrder($id)
    {
        $auction = Auction::findOrFail($id);
        $auction->update([
            'po_approved' => 1
        ]);
        if ($auction->po_approved == 1) {

            //send the notification
            $auction = Auction::findOrFail($id);

            $user = User::findOrFail($auction->user_id);

            $not_title = config('notifications.seller.po_approved');

            $not_link = route('auction.details',['id'=>$auction->id]);

            $not_body = ' Your PO has been approved by the admin';

            $notification = new UserNotification($not_title, $not_body, $not_link);

            NotificationsController::sendToUser($user, $notification);

            return response()->json([
                'status' => 'success',
                'msg' => 'Successfully approved purchase order!'
            ]);
        } else {
            return response()->json([
                'status' => 'fail',
                'msg' => 'Failed!'
            ]);
        }
    }

    /**
     * @description Approve an Invoice
     * @param $id Auction id
     * @return \Illuminate\Http\JsonResponse
     */
    public function approveInvoice($id)
    {

        $invoice = Invoice::where('auction_id',$id)->first();

        if (is_null($invoice)) {

            // return response()->json([
            //     'status' => 'fail',
            //     'msg' => 'Invoice Has Not Been Uploaded Yet'
            // ]);
            return redirect()->back()->with('msg', 'Invoice Has Not Been Uploaded Yet');

        } elseif($invoice->approved !== 1) {
            DB::table('invoices')
            ->where('auction_id',$id)
            ->update(['approved' => 1]);

            $this->sendInvoiceApprovedNotification($invoice);

            // return response()->json([
            //     'status' => 'success',
            //     'msg' => 'Successfully approved Invoice',
            //     'invoice' => $invoice
            // ]);

             return redirect()->back()->with('msg', 'Invoice approved successfully');
        } else {
            // return response()->json([
            //     'status' => 'fail',
            //     'msg' => 'Invoice already approved or declined'
            // ]);

            return redirect()->back()->with('msg', 'Invoice already approved or declined');
        }

    }

    /**
     * @description Will send notification to seller that invoice was approved by admin
     * @param Invoice $invoice
     */
    public function sendInvoiceApprovedNotification(Invoice $invoice)
    {

        $not_link = route('auction.details', ['id' => $invoice->auction->id]);

        $not_title = config('notifications.seller.invoice_approved');

        $not_body = "Invoice for " .$invoice->auction->buyer->company_name ." ( ". $invoice->auction->id ." ) has been approved by the admin!";

        $notification = new UserNotification($not_title, $not_body, $not_link);

        NotificationsController::sendToUser($invoice->user, $notification);
    }


    /**
     * @method sendApproveNotification
     * @description Send notification to seller for auction approval
     * @param Auction $auction
     */
    public function sendApproveNotification(Auction $auction)
    {

        $not_link = route('auction.details', ['id' => $auction->id]);

        $not_tite = config('notifications.seller.auction_approved');

        //$not_body = "Your Auction $auction->company_name has been approved by the admin!";
        $not_body = "Your Auction #".$auction->id." has been approved by the admin!";

        $notification = new UserNotification($not_tite, $not_body, $not_link);

        NotificationsController::sendToUser($auction->user, $notification);
    }


    /**
     * @method sendPendingNotification
     * @description Send notification to seller for auction set to pending
     * @param Auction $auction
     */
    public function sendPendingNotification(Auction $auction)
    {

        $not_link = route('auction.details', ['id' => $auction->id]);

        $not_tite = config('notifications.seller.auction_paused');

        //$not_body = "Your Auction $auction->company_name ( $auction->id ) has been paused by the admin!";
        $not_body = "Your Auction $auction->company_name ( $auction->id ) has been paused by the admin!";

        $notification = new UserNotification($not_tite, $not_body, $not_link);

        NotificationsController::sendToUser($auction->user, $notification);
    }


    /**
     * @description Send notification to seller for auction rejection
     * @param Auction $auction
     * @param $message null
     */
    public function sendDeclineNotification(Auction $auction, $message = null)
    {

        $not_link = route('seller.auctions', ['id' => $auction->id]);

        $not_tite = config('notifications.seller.auction_declined');

        if(!is_null($message) and strlen($message) > 0){

            $not_body = 'Your Auction #'.$auction->id.' has been declined by the admin for the following reason:<br/><strong>'.$message.'</strong>';

        }else{

            $not_body = 'Your Auction has been declined by the admin!';

        }



        $notification = new AuctionDeclineNotification($not_tite, $not_body, $not_link);

        NotificationsController::sendToUser($auction->user, $notification);
    }

    /**
     * @description Send notification to seller for auction stop
     * @param Auction $auction
     * @param $message null
     */
    public function sendStopNotification(Auction $auction, $message = null)
    {

        $not_link = route('seller.auctions', ['id' => $auction->id]);

        $not_tite = config('notifications.seller.auction_stopped');

        if(!is_null($message) and strlen($message) > 0){

            $not_body = 'Your Auction has been stopped by the admin for the following reason:<br/><strong>'.$message.'</strong>';

        }else{

            $not_body = 'Your Auction has been stopped by the admin!';

        }



        $notification = new AuctionStopNotification($not_tite, $not_body, $not_link);

        NotificationsController::sendToUser($auction->user, $notification);
    }



    /**
     * @method getPoFileLinkAttribute
     * @return string
     */
    public function getPoFileLinkAttribute(Request $request,$id)
    {
    
        $document = Auction::findOrFail($id); 
        $path = DownloadFile::getDownloadLink('purchase_orders',$document->po_file_name);
        
        if($request->action == 'view'){
            // $path = public_path('upload/itsolutionstuff.png');
            $isExists = File::exists($path);
            if(!$isExists){
                return redirect()->back()->with('msg', 'FIle Not Found');
            }else
                return response()->file($path);
        }
        else
        {
            // $path = public_path('upload/itsolutionstuff.png');
            $isExists = File::exists($path.'/'.$id.'.jpg');
            if(!$isExists){
                return redirect()->back()->with('msg', 'FIle Not Found');
            }else
                return response()->download($path,$id.'.jpg');
        }    
    }


    /**
     * @method onExportAuctions
     * @description Exports the auction as a csv by passing the id of the auction if no id is passed then export all the auctions
     * @param null $id
     * @return mixed
     */
    public function onExportAuctions($id = null)
    {


        if (is_null($id)) {

            $columns = collect([]);

            $auctions = Auction::with('user', 'buyer')->all();
            foreach ($auctions->toArray() as $key => $a){

                $columns->push($key);

            }

            return Excel::download(new Exporter($auctions, $columns->toArray()), 'auctions.xlsx');

        } else {

            $columns = collect([]);

            $auctions = Auction::with('user', 'buyer')->find($id);

            foreach ($auctions->toArray() as $key => $a){

                $columns->push($key);

            }

            return Excel::download(new Exporter($auctions, $columns->toArray()), 'auction-'.$id.'.xlsx');
        }


    }

    public function investorExportAuctions($id = null)
    {
        $columns = array(
                        '0'=>'Investor',
                        '1'=>'Amount',
                        '2'=>'Status',
                        '3'=>'Date/Time',
                        '4'=>'Reference',
                    );
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

                        if($approved_bid_amount > 0){
                            //partially approved bids
                            $array_approved_bids[$k]['bid_id']          = $bids[$i];
                            $array_approved_bids[$k]['amount']          = $approved_bid_amount;
                            $array_approved_bids[$k]['roi']             = $stepwise_roi;
                            $array_approved_bids[$k]['is_accepted']     = 1;
                            $k++;
                        }
                        
                        
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
            
            foreach ($array_approved_bids as $key => $value) {
                if($value['roi'] > 0 )
                {
                    $po_value_list =  $value['amount'] * (1 + ( $value['roi'] / 100)) ;
                }
                if($value['roi'] == 0){
                    $po_value_list = $value['amount'];
                }

                $share_of_po_list =  $po_value_list / $po * 100;
                $share_of_po =  number_format((float)$share_of_po_list, 2, '.', '');
                $profit  = $po_value_list - $value['amount'];

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

        $final_data = array();

        foreach ($array_approved_bids as $key => $bid) {
            if($bid['is_accepted'] == 1){
                if($bid['bid_id']->paid == 1){
                    $status = 'Released';
                }else{
                    $status = 'Yet to be released';
                }
                $final_data[] = array(
                            '0'=>optional($bid['bid_id']->investor)->user_name,
                            '1'=>$bid['value_of_po'],
                            '2'=>$status,
                            '3'=>\App\Helpers\FormattedDateTime ::format($bid['bid_id']->paid_datetime),
                            '4'=>$bid['bid_id']->reference,
                        );  
            }
            
        }
        
        return Excel::download(new Exporter($final_data, $columns), 'auction-investor-'.$id.'.xlsx');
    }

    public function sellerExportAuctions($id = null)
    {
        $columns = array(
                        '0'=>'Item',
                        '1'=>'Amount',
                        '2'=>'Status',
                        '3'=>'Date/Time',
                        '4'=>'Reference',
                    );
        $auction = Auction::with(['bids', 'user', 'seller'])->find($id);

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
        
        $final_data = array();

        $final_data[0] = array(
                            '0'=>'Target funding amount',
                            '1'=>$po,
                            '2'=>'Retained',
                            '3'=>'--',
                            '4'=>'--',
                        );

        $final_data[1] = array(
                            '0'=>'Funds raised',
                            '1'=>$po,
                            '2'=>'Retained',
                            '3'=>'--',
                            '4'=>'--',
                        );

        $final_data[2] = array(
                            '0'=>'Agency fees',
                            '1'=>trim($auction->agency_fee,"£"),
                            '2'=>($auction->fees_release == null)?'Retained':'Released',
                            '3'=>\App\Helpers\FormattedDateTime ::format($auction->fees_release_datetime),
                            '4'=>$auction->fees_release_reference,
                        );

        $final_data[3] = array(
                            '0'=>'Funding Joint fees',
                            '1'=>trim($auction->funding_joint_fee,"£"),
                            '2'=>'Retained',
                            '3'=>'--',
                            '4'=>'--',
                        ); 

        $final_data[4] = array(
                            '0'=>'Funds available exc. Agency fee',
                            '1'=>$auction->net_funding_available,
                            '2'=>($auction->paid_out == 1)?'Released':'Retained',
                            '3'=>\App\Helpers\FormattedDateTime ::format($auction->paid_out_datetime),
                            '4'=>$auction->paid_out_reference,
                        ); 
            
        return Excel::download(new Exporter($final_data, $columns), 'auction-seller-'.$id.'.xlsx');
    }


    /**
     * @method getWinners
     * @deprecated
     * @param $id
     * @return mixed
     */
    public function getWinners($id)
    {
        return WinningBids::getResults($id);
    }

}
