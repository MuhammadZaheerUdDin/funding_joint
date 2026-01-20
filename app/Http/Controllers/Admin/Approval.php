<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Bid;
use App\Notifications\UserApproved;
use App\Notifications\UserNotification;
use App\Notifications\UserRejected;
use Illuminate\Http\Request;
use App\Model\Users\User;
use ZipArchive;


class Approval extends Controller
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
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function approveUser($id, $type)
    {
        $user = User::where('id', $id)->first();



        if ($type == 1){
            if($user->seller()->exists() && !$user->seller->credit_limit ){
                return redirect()->back()->withMessage('Cannot approve user before you assign credit');
            }
            else if($user->seller()->exists() && !$user->seller->experian_rating ){
                return redirect()->back()->withMessage('No experian rating given');
            }else{
                $user->update(['approved' => $type]);
                $user->notify(new UserNotification('Registration Approval', 'You have been approved by the Admin'));
                $user->notify(new UserApproved($user));
            }

        } else{
            $user->update(['approved' => $type]);
            $user->notify(new UserNotification('Registration Rejected', 'You have been rejected by the Admin'));
            $user->notify(new UserRejected($user));
        }


        return redirect()->back();

    }


    public function approveBid($id)
    {
        $bid = Bid::findOrFail($id);

        $bid->update([
            'approved' => 1
        ]);

        return redirect()->back()->with('msg', 'Approved Bid');
    }
}
