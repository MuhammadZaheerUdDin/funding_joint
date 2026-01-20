<?php

namespace App\Http\Controllers\Auction;

use App\Model\Auction\Auction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class SellerAuctionController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $status = $request->AuctionStatus;

        $currentDate = date('Y-m-d');

        $auction = Auction::with('buyer');

        $auctions = $auction->where('user_id', $user->id)->where('auction_completed',1);//->orderBy('created_at', 'DESC');//->paginate(9);


        if ($request->id) {
            $auctions = $auctions->where('id', '=', $request->id);//->orderBy('created_at', 'DESC')->get();
        }
        if ($status == "Live") {
            $auctions = $auctions->where('status', 'Live');//->orderBy('created_at', 'DESC')->IsLive();
        }

        if ($status == "Pending") {
            $auctions = $auctions
                ->where('auctions.approved', null);//->orderBy('created_at', 'DESC');//->paginate(9);
        }


        if ($status == "Declined") {
            $auctions = $auctions->where('approved', 2);//->orderBy('created_at', 'DESC')->paginate(9);
        }


        if ($status == "Complete") {
            $auctions = $auction->EndedAuctions();
        }

        $auctions = $auctions->orderBy('created_at', 'DESC')->paginate(9);
        /*print_r('<pre>');
        print_r($auctions);
        exit;*/
        return view('seller.auctions', compact('auctions'));
    }

    public function filterByStatus(Request $request)
    {

    }
}
