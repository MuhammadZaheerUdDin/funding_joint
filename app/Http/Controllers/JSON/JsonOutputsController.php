<?php

namespace App\Http\Controllers\JSON;

use App\Http\Controllers\Admin\AdminTransactionsController;
use App\Model\Users\User;
use App\Model\Users\Investor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Bid;

class JsonOutputsController extends Controller
{
    /**
     * Get All users
     * @return \Illuminate\Http\JsonResponse
     */
    public function users()
    {
        $users = User::where('user_type', '!=', 1)
            ->where('approved','=',1)
            ->with(['seller', 'investor'])
            ->orderBy('email')
            ->get();
        return response()->json($users);
    }

    /**
     * get user bank details
     * @param $user_id
     * @return mixed
     */
    public function bankDetails($user_id)
    {
        $user = User::findOrFail($user_id);

        return $user->bankDetails;
    }

    /**
     * @method createReference
     * @description Create a random string transaction reference with initals based on user type
     * @param  $request
     * @return mixed
     */
    public function createReference(Request $request)
    {
        $user = User::findOrFail($request->user_id);
//        $reference = $user->getRole() . str_random(20) . time();
        $reference = AdminTransactionsController::createReference($user->id);
        return response($reference);
    }

    public function auctionDetails($user_id)
    {
        $user = User::findOrFail($user_id);
        if($user->user_type == 2){
            return $user->auctions;
        }else{
            $users = Bid::where('user_id', '=', $user_id)->orderBy('auction_id')->get();
            return response()->json($users);
        }
        
        
    }
}
