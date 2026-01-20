<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Users\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class NotificationsController extends Controller
{

    protected $itemsPerPage = 10;

    public function index(Request $request)
    {

        $all = Auth::user()->notifications()->orderBy('created_at','DESC')->paginate($this->itemsPerPage);
        $read =  Auth::user()->notifications()->orderBy('created_at','DESC')->whereNotNull('read_at')->paginate($this->itemsPerPage);
        $unRead =   Auth::user()->unreadNotifications()->orderBy('created_at','DESC')->paginate($this->itemsPerPage);
        foreach ($all as $notification) {
            $notification->markAsRead();
        }

        switch ($request->get('SortBy')){

            case 'recent':
                $all = Auth::user()->notifications()->orderBy('created_at','DESC')->paginate($this->itemsPerPage);
                $read =  Auth::user()->notifications()->orderBy('created_at','DESC')->whereNotNull('read_at')->paginate($this->itemsPerPage);
                $unRead =  Auth::user()->unreadNotifications()->orderBy('created_at','DESC')->paginate($this->itemsPerPage);
                break;
            case 'oldest':
                $all = Auth::user()->notifications()->orderBy('created_at','ASC')->paginate($this->itemsPerPage);
                $read =  Auth::user()->notifications()->orderBy('created_at','ASC')->whereNotNull('read_at')->paginate($this->itemsPerPage);
                $unRead = Auth::user()->unreadNotifications()->orderBy('created_at','ASC')->paginate($this->itemsPerPage);
                break;

        }   

        return view('admin.notifications',[
            'notifications'=>$all,
            'read' => $read,
            'unRead' => $unRead,
            'user_id'=> Auth::user()->id
        ]);
    }

    public function markAsRead($id){
        Auth::user()->unreadNotifications->where('id', $id)->markAsRead();
        return redirect()->route('notifications');
    }


    public static function sendToUser($user,$notifiable){
        Notification::send($user,$notifiable);
    }

    /**
     * Sends a notification to admins
     * @param $notifiable Notification object
     */
    public static function sendToAdmins($notifiable){
        $admins = User::where('user_type', '=', 1)->get();

        Notification::send($admins,$notifiable);
    }


    /**
     * Sends a notificatio to admins
     * @param $notifiable Notification object
     */
    public static function sendToUsers($usersIDs,$notifiable){
        $users = User::whereIn('id',$usersIDs)->get();
        Notification::send($users,$notifiable);
    }



}
