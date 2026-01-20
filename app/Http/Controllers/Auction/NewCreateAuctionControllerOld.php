<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 2/19/2019
 * Time: 2:33 PM
 */

namespace App\Http\Controllers\Auction;

use App\Builders\Auction\Steps\StepFour;
use App\Builders\Auction\Steps\StepThree;
use App\Builders\Auction\Steps\StepTwo;
use App\Helpers\AuctionSettings;
use App\Helpers\AuctionStep4;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Controllers\Controller;


use App\Builders\Auction\Steps\StepOne;
use App\Model\Auction\Auction;
use App\Notifications\AdminNotification;
use Illuminate\Support\Facades\Auth;
use App\Builder\Auction\AuctionBuilder;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request  as HTTPRequest;
use Illuminate\Support\Facades\Validator;
use App\Model\Buyer\Buyer;


class NewCreateAuctionController extends Controller
{

    public function first(Request $request){

        $stepsBuilder = new StepOne();
        $auctionBuilder = new AuctionBuilder($stepsBuilder);

        if(Auth::user()->count() > 0) {
           
             $buyers = Auth::user()->buyer()->where('approved',1)->get();

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
        $form->text('turnover', '', 'text')->rule('required');
        $form->text('address_1', '', 'text')->rule('required|max:250');
        $form->text('address_2', '', 'text');
        $form->text('address_3', '', 'text');
        $form->text('town', '', 'text')->rule('required|max:50');
        $form->text('county', '', 'text')->rule('max:50');
        $form->text('post_code', '', 'text')->rule('required|max:50');
        $form->text('company_website', '', 'text')->rule('required');

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

        $form->submit('Save');


        $form->saved(function () use ($form) {
            print_r(11);
            exit;
            $form->message("Buyer was saved !");
            $form->link("/step-2/", "Back to buyers");
            $this->sendNotificationToAdmin($form->model);

            return redirect(route('second',$form->model->id));
        });

        $form->build();

//        return view('buyers.create', compact('form'));
        // echo storage_path() . "/app/public/occupations.json";
        // exit;
        return $form->view('seller.create-auction-step-one-form', compact('form','buyers'));
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
        $not_link = route('buyers.show', ['id' => $buyer->id]);
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

        $settings = AuctionSettings::getSettings();

        $stepsBuilder = new StepTwo($buyer_id);

        $auctionBuilder = new AuctionBuilder($stepsBuilder);

        $form = $auctionBuilder->generate();
        
        $form->build();

        return $form->view('seller.create-auction-step-two-form', compact('form', 'settings'));

    }
    /**
     * @param Request $request
     * @method third
     * @return mixed
     */
    public function third(Request $request)
    {

        $settings = AuctionSettings::getSettings();

        $stepsBuilder = new StepThree();

        $auctionBuilder = new AuctionBuilder($stepsBuilder);

        $form = $auctionBuilder->generate();

        $form->build();

        return $form->view('seller.create-auction-step-three-form', compact('form', 'settings'));

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

        //if i have the id i need to edit
        if(isset($auction_id)){

            //set the session
            session(['auction_id' => $auction_id]);

        }

        $settings = AuctionSettings::getSettings();

        $stepsBuilder = new StepFour();

        $auctionBuilder = new AuctionBuilder($stepsBuilder);

        $form = $auctionBuilder->generate();

        $auction = Auction::find($id);

        $form["funding_period_form"]->build();

        return $form['funding_period_form']->view('seller.create-auction-step-four-form', compact('form', 'settings','id', 'auction'));


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

            $updated = $auction->update(['auction_confirmed' => $request->auction_confirmed]);

            if($updated){

                $this->notifyAdmin($auction);

                session()->forget('auction_id');

                session()->forget('buyer_id');

            }



        } catch (\Exception $exception) {

            logger()->error($exception);

            return redirect()->back()->with('message', 'Unable confirm');
        }

        return redirect(route('auction.details',$request->auction_id));
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
    }


}
