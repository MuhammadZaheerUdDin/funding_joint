<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Requests\Admin\SellerUpdateRequest;
use App\Http\Requests\BidRequest;
use App\Http\Requests\TermsFormRequest;
use App\Http\Requests\InvestorFormRequest;
use App\Model\Auction\Auction;
use App\Model\Bid;
use App\Notifications\AdminNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Users\Investor;
use Illuminate\Support\Facades\Auth;
use App\Model\Users\User;
use Illuminate\Support\Facades\Notification;


class InvestorController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        if (is_null(Auth::user())) {

            return redirect('/user-login/investor');

        }
        if(Auth::user()->investor()->exists()){

            return redirect()->route('profile.view')->with('msg','Already created your profile!');
        }

        $occupations_file = file_get_contents(storage_path() . "/app/public/occupations.json");

        $occupations = json_decode($occupations_file, true);

        $professions_file = file_get_contents(storage_path() . "/app/public/professions.json");

        $professions = json_decode($professions_file, true);

        $nationalities_file = file_get_contents(storage_path() . "/app/public/nationalities.json");

        $nationalities = json_decode($nationalities_file, true);

        $countries_file = file_get_contents(storage_path() . "/app/public/countries.json");

        $countries = json_decode($countries_file, true);

        $locations_file = file_get_contents(storage_path() . "/app/public/locations.json");

        $locations = json_decode($locations_file, true);

        $fullReg = new Investor();
        
        
        return view('investor.investor-full-registration', ['investor' => $fullReg, 'locations' => $locations, 'countries' => $countries['countries'], 'nationalities' => $nationalities['nationalities'], 'occupations' => $occupations['occupations'],'professions' => $professions['professions']]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvestorFormRequest $request)
    {
        //
        $validate = $request->validated([
                                'first_name'=>'required'
                            ]);

        $user = Auth::user();

        if ($user->id) {
            $user->is_completed = 1;
            $user->save();

            $values = array_except($request->all(), ['_token']);

            $user->investor()->create($values);
            if($request->otherNatureOfEmployers){
                $user->investor->update([
                    'nature_employers_business' => $request->otherNatureOfEmployers
                ]);
            }
        }


        try {


        } catch (\ Exception $exception) {

            logger($exception);

        }

        //Notification title
        $not_title = config('notifications.admin.investor_registered');

        $not_body = $user->full_name . ' registered as investor. Click to review and approve.';

        $not_link = route('users',['id' => $user->id]);

        $notification = new AdminNotification($not_title,$not_body,$not_link);

        NotificationsController::sendToAdmins($notification);

        return redirect('enter-bank-details');

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


    public function confirm()
    {

        $confirm = new Investor();

        return view('investor.investor-confirmation', ['investor' => $confirm]);

    }

    public function confirmation(TermsFormRequest $request)
    {


        try {

            Investor::where('user_id', Auth::id())->update(['agree' => $request->agree]);

        } catch (\Exception $exception) {

            logger()->error($exception);

            return redirect()->back()->with('message', 'Unable confirm terms and conditions.');

        }

        return view('auth.registration_complete');

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


    public function adminUpdate(Request $request, $id)
    {
        $id = $request->id;
        $seller = Investor::where('id', $id);
        $seller->update([
            'experian_rating' => $request->experian_rating
        ]);
        return redirect()->route('profile.view')->with('message', 'Investor Updated');
    }



}
