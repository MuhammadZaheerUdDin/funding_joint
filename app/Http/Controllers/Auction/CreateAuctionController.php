<?php
namespace App\Http\Controllers\Auction;
use App\Crud\Auction\AuctionCrud;
use App\Helpers\AuctionSettings;
use App\Helpers\AuctionStep2;
use App\Helpers\AuctionStep3;
use App\Helpers\AuctionStep4;
use App\Helpers\OccupationHelper;
use App\Http\Controllers\Admin\NotificationsController;
use App\Model\Auction\Auction;
use App\Model\Buyer\Buyer;
use App\Model\Users\User;
use App\Notifications\AdminNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Zofe\Rapyd\Facades\DataEdit;
use Zofe\Rapyd\Facades\DataGrid;
use Zofe\Rapyd\Facades\DataForm;
use Zofe\Rapyd\Facades\DataSet;
use Zofe\Rapyd\Facades\DataFilter;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
class CreateAuctionController extends Controller
{
    // AUCTION STEPS
    public function steps($step, $id)
    {
       
        switch ($step) {
            case 2:
           
                $form = AuctionStep2::setData($id);
                $settings = AuctionSettings::getSettings();
                return view('seller.create-auction-step-two-form', compact('form', 'settings'));
            case 3:
                $form = AuctionStep3::setData($id);
                $settings = AuctionSettings::getSettings();
                return view('seller.create-auction-step-three-form', compact('form', 'settings'));
            case 4:
                // note it's an array of forms
                $form = AuctionStep4::setData($id);
                $settings = AuctionSettings::getSettings();
                return view('seller.create-auction-step-four-form', compact('form', 'settings','id'));
            default:
                echo 'not found';
                break;
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::id();

        $form = DataForm::source(new Buyer);

        $form->add('user_id', '', 'hidden')->insertValue($user_id);
        $form->add('company_name', '', 'text')->rule('required|max:50');
        $form->add('company_registration', '', 'text')->rule('required|max:50');
        $form->add('turnover', '', 'text')->rule('required|integer');
        $form->add('address_1', '', 'text')->rule('required|max:250');
        $form->add('address_2', '', 'text');
        $form->add('address_3', '', 'text');
        $form->add('town', '', 'text')->rule('required|max:50');
        $form->add('county', '', 'text')->rule('required|max:50');
        $form->add('post_code', '', 'text')->rule('required|max:50');
        $form->add('company_website', '', 'text');
        $form->add('job_title','','select')->option('','Select')->options(OccupationHelper::getOccupations());
        $form->add('occupations', '', 'text');
        $form->add('title', '', 'text');
        $form->add('first_name', '', 'text');
        $form->add('last_name', '', 'text');
        $form->add('email', '', 'text');
        $form->add('phone_code', '', 'text')->rule('required|integer');
        $form->add('phone', '', 'text')->rule('required|integer');
        $form->submit('REGISTER BUYER HERE');
        $form->saved(function () use ($form) {
            // get latest buyer to display and use
            $user_id = Auth::id();
            $buyer_id = Buyer::select()->where('user_id', $user_id)->get()->last();
            $form->message("Buyer Added");
            $not_title = config('notifications.admin.buyer_created');
            $not_link = route('buyers.show',['id'=>$buyer_id]);
            $not_body = Auth::user()->full_name . ' registered a buyer.';
            $notification = new AdminNotification($not_title, $not_body, $not_link);
            NotificationsController::sendToAdmins($notification);
            return Redirect::to("/create-auction-step-2/2/" . $buyer_id->id);
        });
        $form->build();
        if ($form->hasRedirect()) {
            $user_id = Auth::id();
            $buyer_id = Buyer::select()->where('user_id', $user_id)->get()->last();
            return Redirect::to("/create-auction-step-2/2/" . $buyer_id->id);
        }
        if(Auth::user()->buyer()->count() > 0) {
            $buyers = Auth::user()->buyer()->get();
        } else {
            $buyers = [];
        }
        return view('seller.create-auction-step-one-form', compact('form', 'buyers'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {

            $auction = Auction::findOrFail($request->auction_id);

            $auction->update(['auction_confirmed' => $request->auction_confirmed]);

            $this->notifyAdmin($auction);

        } catch (\Exception $exception) {

            logger()->error($exception);

            return redirect()->back()->with('message', 'Unable confirm');
        }
        return redirect('/my-auctions');
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
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function editIframe($auction_id)
    {
        $settings = AuctionSettings::getSettings();

        $crud = new AuctionCrud();

        $form = $crud->update($auction_id);

        $form->build();

        return $form->view('seller.editIframe', compact('form', 'settings'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
