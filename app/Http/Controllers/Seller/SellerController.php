<?php

namespace App\Http\Controllers\Seller;

use App\Http\Requests\Admin\SellerUpdateRequest;
use App\Http\Requests\SellerFormRequest;
use App\Http\Requests\SellerTermsFormRequest;
use App\Model\Auction\Auction;
use App\Model\Users\Seller;
use App\Model\Bank\BankDetails;
use App\Model\Users\User;
use App\Notifications\AdminNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;


class SellerController extends Controller
{

    public function __construct()
    {


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (is_null(Auth::user())) {

            return redirect('/user-login/seller');
        }

        $path = file_get_contents(storage_path() . "/app/public/occupations.json");

        $occupations = json_decode($path, true);

        $fullReg = new Seller();

        return view('seller.full-registration', ['seller' => $fullReg, 'occupations' => $occupations['occupations']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SellerFormRequest $request)
    {

        try {
            
            $validated = $request->validated();
            $request->except('_token');

            $user = Auth::user();
            $user->is_completed = 1;
            $user->save();
            $request->request->add(['is_completed' => '1']);
            
            $user->seller()->create($request->all());

            if($request->otherHearOfUs){
                $user->seller->update([
                    'hear_of_us' => $request->otherHearOfUs
                ]);
            }

            if($request->otherCompanyType){
                $user->seller->update([
                    'company_type' => $request->otherCompanyType
                ]);
            }

            //Notification title
//            $n_body = $user->email . '  registered successfully';
            $n_body = $request->first_name.' '.$request->last_name.' registered as a seller. Click to review and approve.';
            $not_link = route('users',['id' => $user->id]);
            //Get All Admins
            $admins = User::where('user_type', '=', 1)->get();

            Notification::send($admins, new AdminNotification('Seller Registered', $n_body,$not_link));


        } catch (\Exception $exception) {

            logger()->error($exception);

        }

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SellerTermsFormRequest $request)
    {

        // dd($request->agree);

        try {
            Seller::where('user_id', Auth::id())
                ->update([
                    'agree' => $request->agree,
                    'no_other_bank'=>$request->no_other_bank
                ]);

        } catch (\Exception $exception) {

            logger()->error($exception);
            return redirect()->back()->with('message', 'Unable confirm t and c.');

        }


        return view('auth.registration_complete');

    }


    public function confirm()
    {

        $confirm = new Seller();

        return view('seller.seller-confirmation', ['seller' => $confirm]);

    }


    public function adminUpdate(SellerUpdateRequest $request)
    {
        $id = $request->show;
        $type = $request->type;
        if ($type == "seller") {
            $seller = Seller::where('id', $id);
            $seller->update([
                'credit_limit' => $request->credit_limit,
                'experian_rating' => $request->experian_rating
            ]);
            return redirect()->back()->with('message', 'Seller Updated');
        } else {
            return redirect()->back()->with('message', 'Cannot update Seller');
        }

    }


    /**
     * Get Auctions from seller that have ended
     * @param Seller $seller
     * @return mixed
     */
    public function history(Seller $seller)
    {
        $auctions = Auction::where('user_id', $seller->user_id)->paginate(15);

        return view('seller.history',compact('seller'))->withAuctions($auctions);
    }
}
