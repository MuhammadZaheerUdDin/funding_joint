<?php

namespace App\Http\Controllers\Bank;

use App\Http\Requests\BankFormRequest;
use App\Model\Bank\BankStatement;
use Illuminate\Cache\FileStore;
use Illuminate\Support\Facades\Storage;
use App\Model\Users\Seller;
use App\Model\Bank\BankDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BankDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $bankDetails = new BankDetails();

        $user = Auth::user();

        //dd($user['user_type']);
        // investor and seller use banking but have different return forms
        if($user['user_type'] === 2) {
            return view('bankdetails.enter-bank-details', ['bankDetails' => $bankDetails]);
        } else {
            return view('bankdetails.enter-bank-details-investor', ['bankDetails' => $bankDetails]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BankFormRequest $request)
    {
        // todo check should only have one bank account

     try {

        $validate = $request->validated();

        $request->except('_token');

        $user = Auth::user();

         $oldBankDetails = $user->bankDetails()
             ->where('user_id',$user->id)
             ->first();
         if($oldBankDetails===null){
            $data = $user->bankDetails()->create($request->all());
         }else{
             $data = $oldBankDetails->update($request->all());
         }


      } catch (\Exception $exception) {

         logger()->error($exception);
     }
     // investor and seller us banking but have different return
        if($user['user_type'] === 2) {
            // return redirect('upload-bank-statement');
            return redirect('seller-confirm');
        } else {
            return redirect('identity-verification');
        }

   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
