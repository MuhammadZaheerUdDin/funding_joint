<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 2/19/2019
 * Time: 12:51 PM
 */

namespace App\Crud\Auction;


use App\Model\Auction\Auction;
use App\Model\Buyer\Buyer;
use Illuminate\Support\Facades\Session;
use Zofe\Rapyd\Facades\DataEdit;
use Zofe\Rapyd\Facades\DataForm;

use App\Notifications\AdminNotification;
use App\Http\Controllers\Admin\NotificationsController;

use App\Helpers\OccupationHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class BuyerCrud
{

    protected $user;

    protected $buyer_id;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * @method create
     * @description Generates the crud for creating a buyer
     * @return mixed
     */
    public function create()
    {

        $form = DataForm::source(new Buyer);
        $form->add('user_id', '', 'hidden')->insertValue($this->user->id);

        $form->add('company_name', '', 'text')->rule('required|max:50');
        $form->add('company_registration', '', 'text')->rule('required|max:50|unique:buyers');
        $form->add('company_registration_date', '', 'date');
        $form->add('turnover', '', 'text')->rule('required');
        $form->add('address_1', '', 'text')->rule('required|max:250');
        $form->add('address_2', '', 'text');
        $form->add('address_3', '', 'text');
        $form->add('town', '', 'text')->rule('required|max:50');
        $form->add('county', '', 'text')->rule('required|max:50');
        $form->add('post_code', '', 'text')->rule('required|max:50');
        $form->add('company_website', '', 'text');
//        $form->add('job_title','','select')->option('','Select')->options(OccupationHelper::getOccupations());
        $form->add('occupations', '', 'text');
        $form->add('title', '', 'select')->option('','Select')->options(Buyer::$titles)->rule('required');
        $form->add('first_name', '', 'text');
        $form->add('last_name', '', 'text');
        $form->add('email', '', 'text');
        $form->add('phone_code', '', 'text')->rule('required');
        $form->add('phone', '', 'text')->rule('required');
        $form->submit('SAVE','BL',['id' => 'submit' , 'disabled' => 'disabled','title'=>'You will be able to edit these details in Step 4 if required.']);
       // $form->submit('REGISTER BUYER HERE 1');
        Buyer::created(function ($model){

            $this->buyer_id = $model->id;

            session(['buyer_id' => $model->id]);


        });

        $form->saved(function () use ($form) {
            // get latest buyer to display and use
            $form->message("Buyer Added");

            $this->sendNotification();

            return redirect()->to("/step-2");


        });

        return $form;

    }


    /**
     * @method update
     * @description Builds the update form for the buyer
     */
    public function update()
    {
        $auction = Auction::find(session('auction_id'));

        $buyer = Buyer::find($auction->buyer_id);

        return  \DataEmbed::source(url('/buyers/editFrame/'. $buyer), 'embed1')->build();

    }

    public function sendNotification()
    {
        $not_title = config('notifications.admin.buyer_created');

        $not_link = route('buyers.show',['id' => $this->buyer_id]);

        $not_body = $this->user->full_name . ' registered a buyer.';

        $notification = new AdminNotification($not_title, $not_body, $not_link);

        NotificationsController::sendToAdmins($notification);

    }

}
