<?php

namespace App\Http\Controllers\Auction;

use App\Http\Requests\BidRequest;
use App\Model\Auction\Auction;
use App\Model\Bid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InvestorAuctionsController extends Controller
{


    public function showMyInvestments(Request $request)
    {

        $user = Auth::user();

        //get Logged in user's bids'
        $bids = Bid::where('user_id', '=', $user->id)->pluck('auction_id')->toArray();
        
        //Get Auctions that the currently logged in user has bid on

        if ($request->status == 'live') {
            $auctions = Auction::whereIn('id', $bids)->with(['user', 'seller', 'bids'])->IsLive()->orderBy('id','DESC')->paginate(9);
        } elseif ($request->status == 'cancelled') {
            $auctions = Auction::whereIn('id', $bids)->with(['user', 'seller', 'bids'])->IsCancelled()->orderBy('id','DESC')->paginate(9);
        } else {
            $auctions = Auction::whereIn('id', $bids)->with([
                'user',
                'seller',
                'bids'
            ])->orderBy('id','DESC')->paginate(9);
        }

        /*print_r('<pre>');
        print_r($auctions[0]);
        exit;*/

        return view('investor.my-investments', compact('auctions'));
    }


}
