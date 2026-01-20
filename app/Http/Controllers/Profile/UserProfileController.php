<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Documents\DocumentsController;
use App\Http\Requests\Investor\InvestorProfileEditRequest;
use App\Http\Requests\InvestorFormRequest;
use App\Http\Requests\SellerEditProfileRequest;
use App\Model\Bank\BankStatement;
use App\Model\Buyer\Buyer;
use App\Model\Identification\Document;
use App\Model\Users\Investor;
use App\Model\Users\Seller;
use App\Model\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Zofe\Rapyd\Facades\DataEdit;
use Zofe\Rapyd\Facades\DataForm;

use Redirect;


class UserProfileController extends Controller
{


    /**
     * Handle get profile
     * Admin can also view sellers and investors profile
     * by accessing /profile?type=TYPE&show=ID
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function profile(Request $request)
    { 
        //print_r("hello");die;

        $user = Auth::user();

        if ($user->user_type == 1) {

            $profile = $user;

            return view('profile.admin.view', compact(['profile']));
        }

        if ($user->user_type == 2) {
            $profile = $user->seller;
        }
        if ($user->user_type == 3) {
            
            $profile = $user->investor;
        }


        if (isset($profile) ) {
            if(!isset($profile->user->bankDetails->bank_name) || !isset($profile->user->bankDetails->account_number)){
                return redirect()->route('enter-bank-details');                
            }
            return $this->show($profile);

        } else {
            if ($user->user_type == 3) {
                //dd("Hello");die;
                return redirect()->route('full-registration-investor');

            } elseif ($user->user_type == 2) {

                return redirect()->route('full-registration-seller');

            } else return redirect()->back()->with('message', 'No Profile was found!');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($profile)
    {
       //dd($profile);
        $successMsg = 0;
        if ($profile->user->user_type == 3)
            return view('profile.investor.view', compact(['profile','successMsg']));
        else
            return view('profile.seller.view', compact(['profile']));
    }


    public function investorShow($profile)
    {
        if ($profile->user->user_type == 3)
        return view('profile.investor.view', compact(['profile']))->with('successMsg','Changes were saved!');

        else
            return view('profile.seller.view', compact(['profile']));
    }


    /**
     * Handle get edit route and distribute views according to user type
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        if ($user->user_type == 2) {
            $profile = $user->seller;
//            dd($profile);
            return $this->editSeller($profile);
        }
        if ($user->user_type == 3) {
            $profile = $user->investor;
            return $this->editInvestor($profile);
        }

    }


    /** Handle edit investor profile view
     * @param $profile
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editInvestor($profile)
    {

        $nationalities_file = file_get_contents(storage_path() . "/app/public/nationalities.json");

        $nationalities = json_decode($nationalities_file, true);
        $nationalities = $nationalities['nationalities'];

        $occupations_file = file_get_contents(storage_path() . "/app/public/occupations.json");

        $occupations = json_decode($occupations_file, true);
        $occupations = $occupations['occupations'];
        $countries_file = file_get_contents(storage_path() . "/app/public/countries.json");

        $countries = json_decode($countries_file, true);
        $locations_file = file_get_contents(storage_path() . "/app/public/locations.json");
        $professions_file = file_get_contents(storage_path() . "/app/public/professions.json");

        $professions = json_decode($professions_file, true);
        $locations = json_decode($locations_file, true);

        return view('profile.investor.edit', compact(['profile', 'nationalities', 'occupations', 'countries', 'locations']))->withProfessions($professions['professions']);

    }


    /** Handle edit seller profile view
     * @param $profile
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editSeller($profile)
    {

        $nationalities_file = file_get_contents(storage_path() . "/app/public/nationalities.json");

        $nationalities = json_decode($nationalities_file, true);
        $nationalities = $nationalities['nationalities'];

        $occupations_file = file_get_contents(storage_path() . "/app/public/occupations.json");

        $occupations = json_decode($occupations_file, true);
        $occupations = $occupations['occupations'];
        $countries_file = file_get_contents(storage_path() . "/app/public/countries.json");

        $countries = json_decode($countries_file, true);
        $locations_file = file_get_contents(storage_path() . "/app/public/locations.json");

        $locations = json_decode($locations_file, true);

        return view('profile.seller.edit', compact(['profile', 'nationalities', 'occupations', 'countries', 'locations']));

    }


    /**
     * Handle post on profile route adn distribute according user type
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse  
     */
    public function postProfile(Request $request)
    {
        $user = Auth::user();
        $user->is_completed = 1;
        $user->save();
        // print_r('<pre>');
        // print_r($request->all());
        // exit;
        //dd($request);
        $request->request->add(['is_completed' => '1']);
        if ($user->user_type == 2) {

            $profile = $user->seller;

            return $this->updateSeller($request);
        }

        if ($user->user_type == 3) {
            return $this->updateInvestor($request);
        }
    }


    /**
     * Handle update investor profile
     * @param $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInvestor($request)
    {
        $user = Auth::user();
        $user->is_completed = 1;
        $user->save();
        $investor_request = new InvestorProfileEditRequest();
        $request->validate($investor_request->rules());


        if ($request->proof) {
            $this->uploadProofOfAddress($request->file('proof'));
        }
        if ($request->identity) {
            $this->uploadIdentity($request->file('identity'));
        }

        //print_r($request->all()); die;

        $update_investor = $user->investor->update($request->all());
        if ($update_investor) {
            //return redirect()->back()->with('message', 'Changes where saved!');
            $user = Auth::user();
            $profile = $user->investor;
            return $this->investorShow($profile);

        }

       
    }

    public function uploadProofOfAddress($file)
    {
        //
        try {
            $file_name = DocumentsController::upload($file,'proofs');
            if ($file_name) {

                $store = new Document();

                $store->user_id = Auth::id();

                $store->file_name = $file_name;

                $store->type_proof = 'address';

                $store->save();
            }


        } catch (\Exception $exception) {

            echo $exception;
        }
    }


    public function uploadIdentity($file)
    {
        //
        try {
            $file_name = DocumentsController::upload($file);
            if ($file_name) {

                $store = new Document();

                $store->user_id = Auth::id();

                $store->file_name = $file_name;

                $store->type_proof = 'identity';

                $store->save();
            }


        } catch (\Exception $exception) {

            echo $exception;
        }
    }


    /**
     * Handle Update seller profile
     * @param $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSeller($request)
    {

        $user = Auth::user();
        //save the file

        $user->is_completed = 1;
        $user->save();

        $seller_request = new SellerEditProfileRequest();

        $request->validate($seller_request->rules());

        if ($request->bank_statement_file) {
            $file = $request->file("bank_statement_file");

            $timestamp = 'user-' . $user->id . '-bankStatements-' . date('Y-m-d');
            $newFilename = $timestamp . '.' . $file->getClientOriginalExtension();

            Storage::disk('bankStatements')->put($newFilename, file_get_contents($file));

            $record = new BankStatement();
            $record->user_id = Auth::id();
            $record->statement_name = $newFilename;
            $record->save();


            return redirect()->back()->with('message', 'File was saved!');

        }

        $requestData = $request->all();
        if($request->otherHearOfUs){
            $requestData['hear_of_us'] = $request->otherHearOfUs;
        }
        if($request->otherCompanyType){
            $requestData['company_type'] = $request->otherCompanyType;
        }
        // print_r('<pre>');
        // print_r($requestData);
        // exit;
        if ($user->seller->update($requestData)) {
            return redirect()->back()->with('message', 'Changes were saved!');

        }

        return redirect()->route('profile.view');
    }


    public function uploadBankStatement(Request $request)
    {

        try {

            //$file_name = DocumentsController::setDocumentName($request->bank_statement_file);
            Storage::disk('bankStatements')->put($request['bank_statement_file'], 'Contents');

            $record = new BankStatement();
            $record->user_id = Auth::id();
            $record->statement_name = $request['bank_statement_file'];
            $record->save();


            return redirect()->back()->with('message', 'File was saved!');


        } catch (\Exception $exception) {

            logger()->error($exception);

            return redirect()->back()->with('message', 'Unable to upload file.');

        }

    }


    /**
     * @return redirect change password view or back if error
     */
    public function getChangePassword()
    {
        $user = Auth::user();
        if (!$user)
            return redirect()->route('login');

        if (!isset($user))
            return redirect()->back();
        else
            return view('profile.changepassword', ['user' => $user]);
    }

    /**
     * Change user's password  and redirect to profile if success else display error
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postChangePassword(Request $request)
    {

        $user = Auth::user();

        if (!(Hash::check($request->current_password, Auth::user()->password))) {
            return redirect()->back()->withErrors(['current_password' => 'Your current password does not matches with the password you provided. Please try again.']);
        }

        $validation = $this->validate($request, [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);

        if ($validation) {
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->route('profile.view')->withMessage('Password successfully changed');
        }
    }
}
