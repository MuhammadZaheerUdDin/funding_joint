<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 2/19/2019
 * Time: 2:33 PM
 */

namespace App\Http\Controllers\Auction;

use App\Crud\Auction\AuctionCrud;
use App\Builders\Auction\Steps\StepFour;
use App\Builders\Auction\Steps\StepThree;
use App\Builders\Auction\Steps\StepTwo;
use App\Helpers\AuctionSettings;
use App\Helpers\AuctionStep4;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Controllers\Controller;
use App\Model\SitePage;


use App\Builders\Auction\Steps\StepOne;
use App\Model\Auction\Auction;
use App\Notifications\AdminNotification;
use Illuminate\Support\Facades\Auth;
use App\Builder\Auction\AuctionBuilder;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request  as HTTPRequest;
use Illuminate\Support\Facades\Validator;
use App\Model\Buyer\Buyer;
use Zofe\Rapyd\Facades\DataForm;

use Session;


class NewCreateAuctionController extends Controller
{

	protected $user;

    protected $buyer_id;

    protected $fileName;

    protected $auction;



    public function __construct($buyer_id = null)
    {
        $this->user = Auth::user();

        $this->buyer_id = $this->getBuyerID();

        if(isset($buyer_id)){

            $this->buyer_id = $buyer_id;

        }


    } 

    public function first(Request $request){
        $page = SitePage::where('slug','create-auction-info')->first();

        $stepsBuilder = new StepOne();
        $auctionBuilder = new AuctionBuilder($stepsBuilder);

        if(Auth::user()->count() > 0) {
           
             $buyers = Auth::user()->buyer()->where('approved',1)->get();

             //print_r($buyers);die;

        } else {
         
            $buyers = array();
        }

      
//        $form = $auctionBuilder->generate();
//
//        $form->build();

        $form = \DataForm::source(new Buyer);

        $path = file_get_contents(storage_path() . "/app/public/industries.json");

        $industries = json_decode($path, true);

        $occupations_file = file_get_contents(storage_path() . "/app/public/occupations.json");

        $occupations = json_decode($occupations_file, true);


        $form->add('user_id', '', 'hidden')->insertValue(\Auth::getUser()->id);

        $form->text('company_name', '', 'text')->rule('required|max:50');
        $form->text('company_registration', '', 'text')->rule('required|max:50');//->rule('unique:buyers');
        $form->text('company_registration_date', '', 'text');
       // $form->text('turnover', '', 'text')->rule('required');
        $form->text('address_1', '', 'text')->rule('required|max:250');
        $form->text('address_2', '', 'text');
        $form->text('address_3', '', 'text');
        $form->text('town', '', 'text')->rule('required|max:50');
        $form->text('county', '', 'text')->rule('max:50');
        $form->text('post_code', '', 'text')->rule('required|max:50');
        $form->text('company_website', '', 'text');

        $form->text('job_title', '','text')->rule('required|max:50');//->option('', 'Select')->options($occupations['occupations']);

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

        $form->text('business_type', '', 'text')->rule('required|max:50');// 'select')->option('', 'Select')->options($industries['industries'])->rule('required');

        //$form->submit('Save');
        $form->submit('Save','BL',['id' => 'submit','title'=>'You will be able to edit these details in Step 4 if required.']);
        $form->saved(function () use ($form) {
        //     print_r($form);
        // dd(1);
            $form->message("Buyer was saved !");
            $form->link("/step-2/", "Back to buyers");
            $this->sendNotificationToAdmin($form->model);

            return redirect(route('second',$form->model->id));
        });

        $form->build();

//        return view('buyers.create', compact('form'));
        // echo storage_path() . "/app/public/occupations.json";
        // exit;
        return $form->view('seller.create-auction-step-one-form', compact('form','buyers','page'));
    }


    /**
     * send notification to admin for creating a new buyer
     * @param Buyer $buyer
     */
    public function sendNotificationToAdmin(Buyer $buyer)
    {
        $user = Auth::user();
        $not_title = config('notifications.admin.buyer_created');
        $not_body = "$user->full_name has registered a buyer :  $buyer->company_name ( $buyer->id )";
        $not_link = route('buyers.index');

        $notification = new AdminNotification($not_title, $not_body, $not_link);

        NotificationsController::sendToAdmins($notification);
    }


    /**
     * @method second
     * @param $buyer_id
     * @return mixed
     */
    public function second($buyer_id)
    {
        if(!isset($buyer_id)){

            return redirect()->back()->withErrors(['msg', 'Please select a buyer']);
        }

        $user = Auth::user();
        

        $settings = AuctionSettings::getSettings();
        $stepsBuilder = new StepTwo($buyer_id);

        $auctionBuilder = new AuctionBuilder($stepsBuilder);

        $form = $auctionBuilder->generate();
        
        $form->build();

        //$b_id = Session::put('buyer',$buyer_id);
        $page = SitePage::where('slug','create-auction-info')->first();

        return $form->view('seller.create-auction-step-two-form', compact('form', 'settings','user','page'));

    }
    /**
     * @param Request $request
     * @method third
     * @return mixed
     */
    public function third(Request $request)
    {

       // $buyer = Session::get('buyer');

        $settings = AuctionSettings::getSettings();
        $stepsBuilder = new StepThree();
        $auctionBuilder = new AuctionBuilder($stepsBuilder);
        
        $form = $auctionBuilder->generate();
        $form->build();
        $page = SitePage::where('slug','create-auction-info')->first();
        return $form->view('seller.create-auction-step-three-form', compact('form', 'settings','page'));

    }

    /**
     * @param Request $request
     * @param $auction_id
     * @description This method takes care of the step 4 logic and the edit as well
     * @method fourth
     * @return mixed
     */
    public function fourth(Request $request, $auction_id = null)
    {
        $id = session('auction_id');
        $buyer_id = session('buyers_id');

        if($id == ''){
            $id = $auction_id;
        }

        //if i have the id i need to edit
        if(isset($auction_id)){
            //set the session
            session(['auction_id' => $auction_id]);
        }

        //Funding Period Form edit

        $settings = AuctionSettings::getSettings();
       
        $stepsBuilder = new StepFour();

        $auctionBuilder = new AuctionBuilder($stepsBuilder);

        $form = $auctionBuilder->generate();

        $auction = Auction::find($id);
        $auction->agency_fee = $settings[0]['agency_fee'];
        $auction->funding_joint_fee = $settings[0]['funding_joint_admin_fee'];

        $form["funding_period_form"]->build();

        //buyer edit

        $buyer_form = DataForm::source(Buyer::find($buyer_id));

        $buyer_form->add('company_name', '', 'text')->rule('required|max:50');
        $buyer_form->add('company_registration', '', 'text')->rule('required|max:50');
        $buyer_form->add('company_registration_date', '', 'date');
        $buyer_form->add('turnover', '', 'text');
        $buyer_form->add('address_1', '', 'text')->rule('required|max:250');
        $buyer_form->add('address_2', '', 'text');
        $buyer_form->add('address_3', '', 'text');
        $buyer_form->add('town', '', 'text')->rule('required|max:50');
        $buyer_form->add('county', '', 'text');//->rule('required|max:50');
        $buyer_form->add('post_code', '', 'text')->rule('required|max:50');
        $buyer_form->text('company_website', '', 'text');
       // $buyer_form->add('occupations', '', 'select')->options(OccupationHelper::getOccupations());
        $buyer_form->add('title', '', 'select')->options([
            'Mr',
            'Mrs',
            'Miss',
            'Dr',
            'Prof'
        ]);
        $buyer_form->add('first_name', '', 'text');
        $buyer_form->add('last_name', '', 'text');
        $buyer_form->text('job_title', '', 'text');
       // $buyer_form->add('job_title', '', 'select')->rule('required|max:50')->options(OccupationHelper::getOccupations());
        $buyer_form->add('email', '', 'text');
        $buyer_form->add('phone_code', '', 'text')->rule('required');
        $buyer_form->add('phone', '', 'text')->rule('required');

        // $buyer_form->submit('Save');

        $buyer_form->saved(function () use ($buyer_form) {


            Session::flash('msg', 'Buyer Can not be updated');
            // Session::flash('msg_f', 'Buyer Can not be updated');

            return redirect()->back();

        });

        $buyer_form->build();

        //auction edit

         $auction_id = session('auction_id');

        $request = Request::capture();

        $auction = Auction::find($auction_id);

        $user = Auth::user();

        $auction_settings = AuctionSettings::getSettings();

        //print_r($user->id);die;

        //print_r($auction);die;

        $crud = new AuctionCrud();

        $auction_form = $crud->update($auction_id);

        $auction_form->build();

      
        $page = SitePage::where('slug','create-auction-info')->first();

        return view('seller.create-auction-step-four-form', compact('form','settings','id', 'auction','buyer_id','buyer_form','auction_form','auction_settings','page'));


    }

    /**
     * @method update
     * @description Marks the auction as confirmed
     */
    public function update()
    {

        $request = Request::capture();
        
        try {

            $auction = Auction::findOrFail($request->auction_id);
            if(isset($request->auction_confirmed) && $request->auction_confirmed == 1){
                $updated = $auction->update(['auction_confirmed' => $request->auction_confirmed]);

                if($updated){

                    $this->notifyAdmin($auction);

                    session()->forget('auction_id');

                    session()->forget('buyer_id');
                }
                return redirect(route('auction.details',$request->auction_id));
            }else{
                return redirect(route('auction.details',$request->auction_id));
            }
            
        } catch (\Exception $exception) {

            logger()->error($exception);

            return redirect()->back()->with('message', 'Unable confirm');
        }

        
//        return redirect('/my-auctions');
    }

    /**
     * @description Send a notification to admin
     * @param Auction $auction
     */
    public function notifyAdmin(Auction $auction){
        $user = Auth::user();
        $not_title = config('notifications.admin.auction_created');
        $not_link = route('admin.auctions',['id'=>$auction->id]);
        $not_body = $user->full_name . ' created an auction for '. $auction->buyer->company_name;
        $notification = new AdminNotification($not_title, $not_body, $not_link);
        NotificationsController::sendToAdmins($notification);
        $update_auction_created = Auction::where('id',$auction->id)->update(['auction_completed' => 1]);

    }

    public function getUserDetails($id){
        $buyer_details = Buyer::where('id',$id)->first();
        //echo $buyer_details;die;
        return $buyer_details;
    }




    /**
     * @return mixed
     */
    public function getAuctionID()
    {
        return Session::get("auction_id");
    }

     /**
     * @return mixed
     */
    public function getBuyerID()
    {
        return Session::get("buyer_id");
    }


    /**
     * @method onAttachTheFileName
     * @param $request
     * @return mixed
     */
    public function onAttachTheFileName($request)
    {

        $this->fileName = false;

        if($request->hasFile("po_file_name")){

            $filename = $request->file('po_file_name')->getClientOriginalName();

            $ext = $request->file('po_file_name')->getClientOriginalExtension();

            $without_ext = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);

            $filename = str_slug(strtolower($without_ext)).'-'.$this->user->id.'-'.time().'.'.$ext;

            $this->fileName =  "/purchase_orders/".$filename;

        }

        return $this;
    }


    public function setFileName($auction_id)
    {
        return 'auction-po-'.$auction_id .'-'.$this->fileName;
    }


}
