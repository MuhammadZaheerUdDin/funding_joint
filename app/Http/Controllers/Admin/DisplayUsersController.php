<?php
namespace App\Http\Controllers\Admin;

use App\Helpers\Exporter;
use App\Http\Controllers\Search\Search;
use App\Http\Controllers\Search\UsersSearch;
use App\Model\Users\User;
use App\Model\Comment;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;


use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;

use App\Notifications\UserNotification;
use Session;

/**
 * Class DisplayUsersController
 * @package App\Http\Controllers
 */
class DisplayUsersController extends Controller
{
    protected $guard = 'admin';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUsers()
    {
        //  $request = Request::url();
        // print_r($request);die;
        $request = Request::capture();
        
        $this->setSearchFields($request->all());

        $results =  UsersSearch::apply($request);

        $fields = $request->all();
        if(count($fields) <= 2){

           $fields =  $this->setSearchFields();

        }
        $user_id= 1;
        //print_r($fields);die;
        return view('admin.users', compact('results', 'fields','user_id'));

    }



    /**
     * @method setSearchFields
     * @param $fields
     * @return array
     */
    public function setSearchFields()
    {
        $fields['sortBy'] = "";
        $fields['creditLimit'] = "";
        $fields['files'] = "";
        $fields['dateTo'] = "";
        $fields['dateFrom'] = "";
        $fields['userStatus'] = "";
        $fields['experianRating'] = "";
        $fields['title'] = "";
        $fields['type'] = "";

        return $fields;

    }

    /**
     * @method onExport
     * @param $id
     * @return mixed
     */
    public function onExport($id)
    {
        $var = Session::get('request_link');
        $link = preg_split("/\//",$var['link']);
        $page_name = array_pop($link );
        $user = User::find($id);
       
        $collection = collect([]);
        $columns = [];
        if($page_name == 'account'){
            if($user->user_type == 3){
                $columns = \DB::connection()->getSchemaBuilder()->getColumnListing("transactions");
                $collection = $var['investorTransaction'];
                Session::forget('request_link');
                return Excel::download(new Exporter($collection, $columns), 'investor_transaction.xlsx'); 
            }if($user->user_type == 2){
                $columns = \DB::connection()->getSchemaBuilder()->getColumnListing("transactions");
                $collection = $var['transaction'];
                Session::forget('request_link');
                return Excel::download(new Exporter($collection, $columns), 'transaction.xlsx'); 
            }
        }else if($page_name == 'auctions'){
            $columns = \DB::connection()->getSchemaBuilder()->getColumnListing("auctions");
            $collection = $var['auctions'];
            Session::forget('request_link');
            return Excel::download(new Exporter($collection, $columns), 'auctions.xlsx');

        }else if($page_name == 'buyers'){
            $columns = \DB::connection()->getSchemaBuilder()->getColumnListing("buyers");
            $collection = $var['buyers'];
            Session::forget('request_link');
            return Excel::download(new Exporter($collection, $columns), 'buyers.xlsx');
        }else if($page_name == 'activity'){
           //echo "string";die;
            if($user->user_type == 2){
                $columns = \DB::connection()->getSchemaBuilder()->getColumnListing("activity");
                $collection = $var['activity'];
                Session::forget('request_link');
                return Excel::download(new Exporter($collection, $columns), 'activity.xlsx');
            }if($user->user_type == 3){
                $columns = \DB::connection()->getSchemaBuilder()->getColumnListing("activity");
                $collection = $var['activity'];
                Session::forget('request_link');
                return Excel::download(new Exporter($collection, $columns), 'investor_activity.xlsx');
            }
        }else if($page_name == 'investments'){
            $columns = \DB::connection()->getSchemaBuilder()->getColumnListing("auctions");
            $collection = $var['auctions'];
            Session::forget('request_link');
            return Excel::download(new Exporter($collection, $columns), 'investments.xlsx');
        }else{
             switch ($user->user_type){

            case 1:
                $collection = $user;
                break;
            case 2:
                $user = User::with('seller')->find($user->id);
                $columns = \DB::connection()->getSchemaBuilder()->getColumnListing("sellers");
                $collection = $user->seller;
                break;
            case 3:
                $user = User::with('investor')->find($user->id);
                $columns = \DB::connection()->getSchemaBuilder()->getColumnListing("investors");
                $collection = $user->investor;
                break;

            }
        }
        return Excel::download(new Exporter($collection, $columns), 'user.xlsx');

    }


    /**
     * @method Get User Comments
     * @param $id
     * @return mixed
     */
    public function getUserComments($id)
    {
        $comments = Comment::where('child_id',$id)->orWhere('commenter_id',$id)->with('user','seller')->get()->toArray();
        return view('admin.get_user_comments', compact('comments'));
    }

    /**
     * @method Get User Comments
     * @param $id
     * @return mixed
     */
    public function addUserComment(Request $request)
    {
        // dd($_POST);
        $comment = new Comment();
        $comment->commenter_id = $_POST['commentable_id'];
        $comment->commentable_id = $_POST['commentable_id'];//$_POST['user_id'];
        $comment->child_id = Auth::user()->id;//$_POST['sent_id'];
        $comment->commentable_type = 'App\Model\Comment';
        $comment->comment = $_POST['message'];
        $comment->save();

        $user = User::where('id',  $_POST['commentable_id'])->first();


        $user->notify(new UserNotification('Admin Message', 'You have got message from Admin'));

        return redirect()->back()->with('success', 'success');
        // echo json_encode(array('success'=>'success'));exit;
    }
}
