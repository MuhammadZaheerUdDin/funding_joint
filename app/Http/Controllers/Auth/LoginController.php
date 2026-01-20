<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function showLoginForm($UserType=null)
    {
        
        switch (strtolower($UserType)){

           

            case 'admin':
            $seller = 'seller';
            $investors = 'investors';
                return view('auth.login', array('UserTypeDescription' => 'admin', 'UserType' => 1), compact('seller','investors'));
            case 'seller':
            $seller = 'seller';
            $investors = 'investors';
                return view('auth.login', array('UserTypeDescription' => 'seller', 'UserType' => 2), compact('seller','investors'));
            case 'investors':
            $seller = 'seller';
            $investors = 'investors';
                return view('auth.login', array('UserTypeDescription' => 'investors', 'UserType' => 3), compact('seller','investors'));
            default :
            $seller = 'seller';
            $investors = 'investors';
                return view('auth.login', compact('seller','investors'));
        }
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {

        return [
            'email' => $request->{$this->username()},
            'password' => $request->password,
            'status' => '1'
        ];

    }

    protected function authenticated(Request $request, $user)
    {
        //


        if(is_null($user)){


            return redirect()->back()->with('message', 'No user found');

        }

        switch ($user->user_type){

            case 1:
                return redirect('users');
            case 2:
                return redirect('full-registration-seller');
            case 3:
                return redirect('full-registration-investor');

        }


    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        $user = Auth::user();

        /**
         * users that have not complete their profile can only access marketplace and notifications
         */
        if( !$user->profileCompleted() ){
            return redirect('/marketplace');
        }

        switch ($user->user_type){
            case 1:
                return redirect('users');
            case 2:
                if(!$user->seller)
                    return redirect('full-registration-seller');
                else
                    return redirect('/dashboard');
            case 3:
                if(!$user->investor)
                    return redirect('full-registration-investor');
                else
                    return redirect('/dashboard');

        }

        // return $this->authenticated($request, $this->guard()->user())
        //   ?: redirect()->intended($this->redirectPath());
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        return redirect('/');
    }




}
