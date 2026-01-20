<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\InvestorFormRequest;
use App\Http\Requests\SellerFormRequest;
use App\Model\Users\Investor;
use App\Model\Users\Seller;
use App\Model\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditUsersController extends Controller
{
    /**
     * Handle Get Request to distribute view according to usertype
     * @param $userType seller|investor
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getEdit($userType, $id)
    {
        switch ($userType) {

            case 'investor':
                return $this->getEditInvestor($id);
                break;
            case 'seller':
                return $this->getEditSeller($id);
                break;
            default:
                return redirect()->back();
        }
    }

    /**
     * Handle Get request to return admin investor edit view
     * @param $id investor id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditInvestor($id)
    {

        $nationalities_file = file_get_contents(storage_path() . "/app/public/nationalities.json");

        $nationalities = json_decode($nationalities_file, true);
        $nationalities = $nationalities['nationalities'];

        $occupations_file = file_get_contents(storage_path() . "/app/public/occupations.json");

        $occupations = json_decode($occupations_file, true);
        $occupations = $occupations['occupations'];
        $countries_file = file_get_contents(storage_path() . "/app/public/countries.json");

        $countries = json_decode($countries_file, true);
        $countries = $countries['countries'];
        $locations_file = file_get_contents(storage_path() . "/app/public/locations.json");

        $locations = json_decode($locations_file, true);
        $locations = $locations['nationalities'];
        //print_r($locations);die;

        $profile = Investor::find($id);
        return view('admin.edit.investor', compact(['profile', 'nationalities', 'occupations', 'countries', 'locations']));
    }

    /**
     * Handle get Request to return admin seller edit view
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditSeller($id)
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


        $profile = Seller::findOrFail($id);

        return view('admin.edit.seller', compact(['profile', 'nationalities', 'occupations', 'countries', 'locations']));
    }


    /** Handle Post request to distribute according to user type
     * @param $userType seller|investor
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit($userType, $id,Request $request)
    {

        switch ($userType) {
            case 'seller':
                return $this->postEditSeller($id,$request);
                break;

            case 'investor':
                return $this->postEditInvestor($id,$request);
            default:
                return redirect()->back();
        }
    }


    /**
     * Handle post request for admin to edit investor
     * @param $id investor id
     * @param $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEditInvestor($id,$request){
        $investor           =   Investor::findorFail($id);

        $investor_request   =   new InvestorFormRequest();
         //print_r($investor_request);die;

        $request->validate($investor_request->rules());

        $investor->update($request->all());



       return redirect('users')->with('msg','Investor Updated Successfully');

    }


    /**
     * Handle Post request for admin to edit seller
     * @param $id seller id
     * @param $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEditSeller($id,$request){
        $seller           =   Seller::findOrFail($id);
        $seller_request   =   new SellerFormRequest();


        $request->validate($seller_request->rules());

        $seller->update($request->all());
        return redirect('users')->with('msg','Seller Updated Successfully');

    }


    public function postEditExperianRating($type,$id,Request $request){
            $seller = Seller::where('id',$id)->first();

            try{
                $seller->update([
                    'experian_rating'=>$request->experian_rating
                ]);
                return redirect()->back()->with('msg',"Updated seller's Experian Rating");
            }
            catch(\Exception $e){

            }

    }


    /**
     * @param $type
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEditCreditLimit($type,$id,Request $request){



        $seller = Seller::where('id',$id)->first();

        try{
            $seller->update([
                'credit_limit'=>$request->credit_limit
            ]);
            return redirect()->back()->with('msg',"Updated seller's Credit Rating");
        }
        catch(\Exception $e){

        }

    }

}
