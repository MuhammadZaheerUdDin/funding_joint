<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 10/29/2018
 * Time: 10:04 AM
 */

namespace App\Http\Controllers\Buyers;

use App\Helpers\Exporter;
use App\Helpers\OccupationHelper;
use App\Http\Controllers\Admin\NotificationsController;
use App\Model\Buyer\Buyer;
use App\Model\Buyer\BuyerTransaction;
use App\Model\Transaction;
use App\Notifications\AdminNotification;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Zofe\Rapyd\Facades\DataForm;
use Illuminate\Http\Request;
use App\Model\Users\User;
use App\Http\Controllers\Admin\AdminTransactionsController;
use Illuminate\Support\Facades\DB;
use App\Model\Auction\Auction;
use DateTime;


class BuyersController
{


    public function __construct()
    {

    }


    public function index()
    {


        $request = Request::capture();
        $user = Auth::user();


        if ($request->get('order') == "title") {

            if ($user->getRole() == "seller") {
                $buyers = $user->buyer()->orderBy('company_name', 'ASC')->simplePaginate(10);
            } else
                $buyers = Buyer::orderBy('company_name', 'ASC')->simplePaginate(10);

        } else {
            if ($user->getRole() == "seller") {
                $buyers = $user->buyer()->orderBy('created_at', 'DESC')->simplePaginate(10);
            } else
                $buyers = Buyer::orderBy('created_at', 'desc')->simplePaginate(10);
        }


        return view('buyers.index', compact('buyers'));

    }


    /**
     * @method show
     * @description This shows the info for a buyer
     * @param $buyer_id
     * @return mixed
     */
    public function show($buyer_id)
    {
        $buyer = Buyer::find($buyer_id);

        $profile = $buyer;

        return view('buyers.show', compact('buyer', 'profile'));
    }

    /**
     * @method edit
     * @description This shows the info for a buyer
     * @param $buyer_id
     * @return mixed
     */
    public function edit($buyer_id)
    {
        $form = DataForm::source(Buyer::find($buyer_id));
        $form->add('company_name', '', 'text')->rule('required|max:50');
        $form->add('company_registration', '', 'text')->rule('required|max:50');
        $form->add('company_registration_date', '', 'text');
        $form->add('turnover', '', 'text');
        $form->add('address_1', '', 'text')->rule('required|max:250');
        $form->add('address_2', '', 'text');
        $form->add('address_3', '', 'text');
        $form->add('town', '', 'text')->rule('required|max:50');
        $form->add('county', '', 'text');//->rule('required|max:50');
        $form->add('post_code', '', 'text')->rule('required|max:50');
        $form->text('company_website', '', 'text');
       // $form->add('occupations', '', 'select')->options(OccupationHelper::getOccupations());
        $form->add('title', '', 'select')->options([
            'Mr',
            'Mrs',
            'Miss',
            'Dr',
            'Prof'
        ]);
        $form->add('experian_rating', '456', 'text');
        $form->add('first_name', '', 'text');
        $form->add('last_name', '', 'text');
        $form->text('job_title', '', 'text');
       // $form->add('job_title', '', 'select')->rule('required|max:50')->options(OccupationHelper::getOccupations());
        $form->add('email', '', 'text');
        $form->add('phone_code', '', 'text')->rule('required');
        $form->add('phone', '', 'text')->rule('required');
        $form->submit('Save');
        $form->saved(function () use ($form) {
            $form->message("Buyer was updated !");
            $form->link("buyers","Buyers List");
        });

        $form->build();
        $buyer = Buyer::find($buyer_id);

        $profile = $buyer;

        return view('buyers.edit', compact('form','profile'));

    }


    /**
     * @method create
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createold()
    {

        $form = \DataForm::source(new Buyer);

        $path = file_get_contents(storage_path() . "/app/public/industries.json");

        $industries = json_decode($path, true);

        $occupations_file = file_get_contents(storage_path() . "/app/public/occupations.json");

        $occupations = json_decode($occupations_file, true);


        $form->add('user_id', '', 'hidden')->insertValue(\Auth::getUser()->id);

        $form->text('company_name', '', 'text')->rule('required|max:50');
        $form->text('company_registration', '', 'text')->rule('required|max:50');
        $form->text('company_registration_date', '', 'date');
        $form->text('turnover', '', 'text');
        $form->text('address_1', '', 'text')->rule('required|max:250');
        $form->text('address_2', '', 'text');
        $form->text('address_3', '', 'text');
        $form->text('town', '', 'text')->rule('required|max:50');
        $form->text('county', '', 'text')->rule('max:50');
        $form->text('post_code', '', 'text')->rule('required|max:50');
        $form->text('company_website', '', 'text')->rule('required');
        $form->text('job_title', '', 'text')->rule('required');

        //$form->add('job_title', '', 'select')->option('', 'Select')->options($occupations['occupations']);

        $form->text('title', '', 'select')->options([
            'Mr',
            'Mrs',
            'Miss',
            'Dr',
            'Prof'
        ]);
        $form->text('first_name', '', 'text')->rule('required');
        $form->text('last_name', '', 'text')->rule('required');
        $form->text('email', '', 'text')->rule('required');
        $form->text('phone_code', '', 'text')->rule('required');
        $form->text('phone', '', 'text')->rule('required');
        $form->text('business_type', '', 'text')->rule('required');

        //$form->text('business_type', '', 'select')->option('', 'Select')->options($industries['industries'])->rule('required');

        $form->submit('Save');


        $form->saved(function () use ($form) {
            $form->message("The details have been saved");
            $this->sendNotificationToAdmin($form->model);

            return redirect('buyers.index')->with('msg', 'Buyer created successfull');

        });

        $form->build();


        $buyer = new Buyer();

        return view('buyers.create', compact('buyer'));
    }

    public function create()
    {

        $buyer = new Buyer();

        return view('buyers.create', compact('buyer'));
    }

    public function submitData(Request $request)
    {
        $user = Auth::user();
        $add_data = array(
                            'company_name'              => $request->company_name,
                            'user_id'                   => $user->id,
                            'first_name'                => $request->first_name,
                            'last_name'                 => $request->last_name,
                            'company_registration'      => $request->company_registration,
                            'company_registration_date' => $request->company_registration_date,
                            'address_1'                 => $request->address_1,
                            'address_2'                 => $request->address_2,
                            'address_3'                 => $request->address_3,
                            'town'                      => $request->town,
                            'county'                    => $request->county,
                            'company_website'           => $request->company_website,
                            'title'                     => $request->title,
                            'email'                     => $request->email,
                            'phone_code'                => $request->phone_code,
                            'phone'                     => $request->phone,
                            'business_type'             => $request->business_type,
                            'job_title'                 => $request->job_title,
                            'post_code'                 => $request->post_code,
                            'created_at'                => date('Y-m-d H:i:s'),
                            'updated_at'                => date('Y-m-d H:i:s')
                        );

        $id = Buyer::insertGetId($add_data);
        $this->sendNotificationToAdmin($id,$request->company_name);
        return redirect('buyers')->with('msg', 'Buyer created successfull');
    }

    /**
     * @method onExport
     * @description Exports the buyer as a csv
     * @param $id
     * @return mixed
     */
    public function onExport($id)
    {

        $buyer = Buyer::find($id);

        $columns = \DB::connection()->getSchemaBuilder()->getColumnListing("buyers");
        // dd($columns);

        return Excel::download(new Exporter($buyer, $columns), 'buyers.xlsx');

    }

    /**
     * @method onApproveBuyer
     * @description Approves the buyer
     */
    public function onApproveBuyer($id)
    {

        $buyer = Buyer::findOrFail($id);

        if($buyer->approved != 1){
            $buyer->update([
                                'approved' => 1
                            ]);
                            $this->sendBuyerApprovedNotification($buyer);
        }
        
        return redirect()->back()->with('msg', 'Approved Buyer');
    }

    public function sendBuyerApprovedNotification(Buyer $buyer)
    {
        $not_title = config('notifications.seller.buyer_approved');
        $not_body = "Admin has approved $buyer->company_name ( $buyer->id )";
        $not_link = route('buyers.show', ['id' => $buyer->id]);
        $notification = new UserNotification($not_title, $not_body, $not_link);

        NotificationsController::sendToUser($buyer->user, $notification);
    }

    /**
     * send notification to admin for creating a new buyer
     * @param Buyer $buyer
     */
    public function sendNotificationToAdmin($id,$company_name)
    {
        $user = Auth::user();
        $not_title = config('notifications.admin.buyer_created');
        $not_body = "$user->full_name has registered a buyer :  $company_name ( $id )";
        $not_link = route('buyers.index');
        $notification = new AdminNotification($not_title, $not_body, $not_link);

        NotificationsController::sendToAdmins($notification);
    }

    /**
     * @method onDeclineBuyer
     * @description Declines the buyer
     */
    public function onDeclineBuyer($id)
    {
        $request = Request::capture();
        $buyer = Buyer::findOrFail($id);
        $message = $request->message;
        $buyer->update([
            'approved' => 0
        ]);
        $this->sendBuyerDeclinedNotification($buyer,$message);
        return redirect()->back()->with('msg', 'Declined Buyer');
    }

    public function addAmount(Request $request)
    {
        $total_paid = BuyerTransaction::where('auction_id',$request->auction_id)->sum('amount_received');
        $add_data = array(
                            'invoice_amount'            => $request->invoice_amount,
                            'auction_id'                => $request->auction_id,
                            'invoice_repayment_due_date'=> $request->invoice_repayment_due_date,
                            'amount_received'           => $request->amount_received,
                            'date_of_receipt'           => date('Y-m-d'),
                            'reference'                 => $request->reference,
                            'outstanding_balance'       =>  ($request->invoice_amount - $total_paid - $request->amount_received),
                            'days_overdue'              => $request->days_overdue,
                            'payment_status'            => $request->payment_status,
                            'status'                    => $request->status,
                            'created_at'                => date('Y-m-d H:i:s'),
                            'updated_at'                => date('Y-m-d H:i:s')
                        );

        BuyerTransaction::insert($add_data);

        $adminUser = User::find(1);
        $reference_admin      =  AdminTransactionsController::createReference($adminUser->id).'_'.rand(1000,3);

        $adminUser->balance->update([
                   'balance' => $adminUser->balance->balance += $request->amount_received
               ]);

        //create new transaction for the payment
        $transaction    = Transaction::create([
            'reference'   =>$reference_admin,
            'amount'      =>$request->amount_received,
            'user_id'     =>$adminUser->id,
            'type'        =>Transaction::CREDIT,
            'description' =>"Buyer Paid",
            'status'      =>'Complete',
            'remarks'     =>'',
            'auction_id'  =>$request->auction_id,
            'confirmed'   => '1',
            'new_balance' => $adminUser->balance_amount
        ]);
        return redirect('auctions/'.$request->auction_id)->with('msg', 'Payment Added successfull');
    }

    public function sendBuyerDeclinedNotification(Buyer $buyer,$message='')
    {
        $not_title = config('notifications.seller.buyer_declined');
        //$not_body = "Admin has declined $buyer->company_name with reason '$message '";
        $not_body = 'Your Buyer '.$buyer->company_name.' has been declined by the admin for the following reason:<br/><strong>'.$message.'</strong>';
        $not_link = route('buyers.show', ['id' => $buyer->id]);
        $notification = new UserNotification($not_title, $not_body, $not_link);

        NotificationsController::sendToUser($buyer->user, $notification);
    }

    /**
     * @method onEditRating
     * @description Attaches the new rating for the buyer
     */
    public function onEditRating($id)
    {

        try {

            $request = Request::capture();

            $bid = Buyer::findOrFail($id);

            $bid->update([
                'experian_rating' => $request->get('experian_rating')
            ]);

            $bid->save();

        } catch (\Exception $e) {

            \Log::error('Something went wrong' . $e->getMessage());

        } finally {

            return redirect()->back()->with('msg', 'Updated the Experian rating');
        }


    }

    /**
     * @method edit
     * @description This shows the info for a buyer
     * @param $buyer_id
     * @return mixed
     */
    public function editIframe($buyer_id)
    {

        $form = DataForm::source(Buyer::find($buyer_id));

        $form->add('company_name', '', 'text')->rule('required|max:50');
        $form->add('company_registration', '', 'text')->rule('required|max:50');
        $form->add('turnover', '', 'text');
        $form->add('turnover_duplicate', '', 'text');
        $form->add('address_1', '', 'text')->rule('required|max:250');
        $form->add('address_2', '', 'text');
        $form->add('address_3', '', 'text');
        $form->add('town', '', 'text');
        $form->add('county', '', 'text');
        $form->add('post_code', '', 'text')->rule('required|max:50');
        $form->add('company_website', '', 'text');
        $form->add('occupations', '', 'select')->options(OccupationHelper::getOccupations());
        $form->add('title', '', 'select')->options([
            'Mr',
            'Mrs',
            'Miss',
            'Dr',
            'Prof'
        ]);
        $form->add('first_name', '', 'text');
        $form->add('last_name', '', 'text');
        $form->add('job_title', '', 'select')->rule('required|max:50')->options(OccupationHelper::getOccupations());
        $form->add('email', '', 'text');
        $form->add('phone_code', '', 'text')->rule('required');
        $form->add('phone', '', 'text')->rule('required');

        $form->submit('Save');

        $form->saved(function () use ($form) {

            Session::flash('msg', 'Buyer was updated');

            return redirect()->back();
        });

        $form->build();

        return $form->view('buyers.editFrame', compact('form'));

    }

    public function buyerDuepaymentList()
    {
        $today_date = date('Y-m-d');
        $date = strtotime($today_date);
        $date = strtotime("-7 day", $date);
        $old_date = date('Y-m-d', $date);

        if(auth()->user()->user_type === 1){
            $allBuyer =  DB::select('SELECT * FROM `buyer_transactions` WHERE auction_id NOT IN (SELECT auction_id  FROM `buyer_transactions` WHERE `outstanding_balance` = 0  ) AND `invoice_repayment_due_date` < "'.$today_date.'" AND `invoice_repayment_due_date` > "'.$old_date.'"  GROUP BY auction_id ORDER BY `buyer_transactions`.`created_at` DESC');
        }elseif (auth()->user()->user_type === 3) {
            $investor_id = auth()->user()->id;
            $allBuyer =  DB::select('SELECT * FROM `buyer_transactions` WHERE auction_id NOT IN (SELECT auction_id  FROM `buyer_transactions` WHERE `outstanding_balance` = 0  ) AND auction_id IN (SELECT auction_id  FROM `bids` WHERE `user_id` = '.$investor_id.'  ) AND `invoice_repayment_due_date` < "'.$today_date.'" AND `invoice_repayment_due_date` > "'.$old_date.'"  GROUP BY auction_id ORDER BY `buyer_transactions`.`created_at` DESC');
            
        }else{
            $seller_id = auth()->user()->id;
            $allBuyer =  DB::select('SELECT * FROM `buyer_transactions` WHERE auction_id NOT IN (SELECT auction_id  FROM `buyer_transactions` WHERE `outstanding_balance` = 0  ) AND auction_id IN (SELECT id  FROM `auctions` WHERE `user_id` = '.$seller_id.'  ) AND `invoice_repayment_due_date` < "'.$today_date.'" AND `invoice_repayment_due_date` > "'.$old_date.'"  GROUP BY auction_id ORDER BY `buyer_transactions`.`created_at` DESC');
            
        }

        foreach ($allBuyer as $key => $value) {
            $allBuyer[$key]->auction = Auction::find($value->auction_id);
            $buyer_transaction = BuyerTransaction::where('auction_id',$value->auction_id)->orderBy('created_at', 'DESC')->first();
            $allBuyer[$key]->outstanding_balance = $buyer_transaction->outstanding_balance;

            $fdate = $today_date;
            $tdate = $value->invoice_repayment_due_date;
            $datetime1 = new DateTime($fdate);
            $datetime2 = new DateTime($tdate);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a');//now do whatever you like with $days

            $allBuyer[$key]->overdue_days = $days;
            
        }

        $title = 'DUE AMOUNTS BY BUYERS';

        return view('buyers.duepayment', compact('allBuyer','title'));

    }

    public function buyerOverDuepaymentList()
    {
        $today_date = date('Y-m-d');
        $date = strtotime($today_date);
        $date = strtotime("-7 day", $date);
        $old_date = date('Y-m-d', $date);


        if(auth()->user()->user_type === 1){
            $allBuyer =  DB::select('SELECT * FROM `buyer_transactions` WHERE auction_id NOT IN (SELECT auction_id  FROM `buyer_transactions` WHERE `outstanding_balance` = 0  ) AND `invoice_repayment_due_date` < "'.$old_date.'"  GROUP BY auction_id ORDER BY `buyer_transactions`.`created_at` DESC');
        }elseif (auth()->user()->user_type === 3) {
            $investor_id = auth()->user()->id;
            $allBuyer =  DB::select('SELECT * FROM `buyer_transactions` WHERE auction_id NOT IN (SELECT auction_id  FROM `buyer_transactions` WHERE `outstanding_balance` = 0  ) AND auction_id IN (SELECT auction_id  FROM `bids` WHERE `user_id` = '.$investor_id.'  ) AND `invoice_repayment_due_date` < "'.$old_date.'"  GROUP BY auction_id ORDER BY `buyer_transactions`.`created_at` DESC');
            
        }else{
            $seller_id = auth()->user()->id;
            $allBuyer =  DB::select('SELECT * FROM `buyer_transactions` WHERE auction_id NOT IN (SELECT auction_id  FROM `buyer_transactions` WHERE `outstanding_balance` = 0  ) AND auction_id IN (SELECT id  FROM `auctions` WHERE `user_id` = '.$seller_id.'  ) AND `invoice_repayment_due_date` < "'.$old_date.'"  GROUP BY auction_id ORDER BY `buyer_transactions`.`created_at` DESC');
        }

        foreach ($allBuyer as $key => $value) {
            $allBuyer[$key]->auction = Auction::find($value->auction_id);
            $buyer_transaction = BuyerTransaction::where('auction_id',$value->auction_id)->orderBy('created_at', 'DESC')->first();
            $allBuyer[$key]->outstanding_balance = $buyer_transaction->outstanding_balance;

            $fdate = $today_date;
            $tdate = $value->invoice_repayment_due_date;
            $datetime1 = new DateTime($fdate);
            $datetime2 = new DateTime($tdate);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a');//now do whatever you like with $days

            $allBuyer[$key]->overdue_days = $days;
            
        }

        
        $title = 'OVERDUE AMOUNTS BY BUYERS';

        return view('buyers.duepayment', compact('allBuyer','title'));

    }

}
