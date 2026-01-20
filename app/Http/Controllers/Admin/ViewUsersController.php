<?php

namespace App\Http\Controllers\Admin;

use App\Model\Auction\Auction;
use App\Model\Users\Investor;
use App\Model\Users\Seller;
use App\Model\Users\User;
//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use Request;
use Session;


class ViewUsersController extends Controller
{
    public function getView($userType, $id, $view='profile')
    {


        switch ($userType) {
            case 'seller':
                return $this->getViewSeller($id, $view);
                break;

            case 'investor':
                return $this->getViewInvestor($id, $view);
            default:
                return redirect()->back();
        }
    }

    public function edit($userType, $id, $view='profile')
    {

        switch ($userType) {
            case 'seller':
                return $this->getViewSeller($id, $view);
                break;

            case 'investor':
                return $this->getViewInvestor($id, $view);
            default:
                return redirect()->back();
        }
    }


    public function getViewSeller($id, $view = 'profile')
    {
        $profile   = Seller::findOrFail($id);
        $user     = User::find($profile->id);
        $user_type = $user->user_type;
        
        switch ($view) {
            case 'profile':
                return view('admin.view.seller.' . $view, compact('profile','user_type'));
                break;
            case 'account':
                $req            = Request::capture();
                $request_link    = Request::url();
                $order = $req->input("SortBy") === "oldest" ? "ASC" : "DESC";
                $transactions = $profile->user->transactions()->orderBy('created_at',$order)->get();
                Session::put('request_link',['link'=>$request_link,'transaction' => $transactions]);
               
                return view('admin.view.seller.' . $view, compact(['profile','transactions','request_link']));
            case 'auctions':
                $auctions= $profile->auctions;
                $request_link    = Request::url();
                Session::put('request_link', ['link'=>$request_link,'auctions' => $auctions]);
                return view('admin.view.seller.' . $view, compact(['profile','auctions','request_link']));
                break;
            case 'buyers':
                $buyers= $profile->user->buyer;
                $request_link    = Request::url();
                Session::put('request_link', ['link'=>$request_link,'buyers' => $buyers]);
                return view('admin.view.seller.' . $view, compact(['profile','buyers','request_link']));
                break;
            case 'activity':
                $activity = $profile->user->notifications()->get();
                $request_link    = Request::url();
                Session::put('request_link', ['link'=>$request_link,'activity' => $activity]);
                return view('admin.view.seller.' . $view, compact('profile', 'activity','request_link'));
                break;
            default:
//                return redirect()->back()->with('msg','Not found');
                break;
        }
    }


    public function getViewInvestor($id, $view = 'profile')
    {
        $profile = Investor::findOrFail($id);
        $user      = User::find($id);
        $user_type = $user->user_type;
        switch ($view) {
            case 'profile':
                return view('admin.view.investor.' . $view, compact('profile','user_type'));
                break;
            case 'account':
                $req = Request::capture();
                $request_link    = Request::url();
                $order = $req->input("SortBy") === "oldest" ? "ASC" : "DESC";
                $transactions = $profile->user->transactions()->orderBy('created_at',$order)->get();
                Session::put('request_link',['link'=>$request_link,'investorTransaction' => $transactions]);
                return view('admin.view.investor.' . $view, compact(['transactions','profile','request_link']));
            case 'investments':
                $request_link    = Request::url();
                $auctions = $profile->investments();
                Session::put('request_link', ['link'=>$request_link,'auctions' => $auctions]);
                return view('admin.view.investor.' . $view, compact(['auctions','profile','request_link']));
                break;
            case 'activity':
                $request_link    = Request::url();
                $activity = $profile->user->notifications()->get();
                Session::put('request_link', ['link'=>$request_link,'activity' => $activity]);
                return view('admin.view.investor.' . $view, compact('profile', 'activity','request_link'));
                break;
        }
        return view('admin.view.investor.' . $view, compact('profile'));
    }
}
