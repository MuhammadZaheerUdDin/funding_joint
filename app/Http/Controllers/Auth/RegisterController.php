<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\AdminNotification;
use App\Notifications\UserRegisteredSuccessfully;
use App\Model\Users\User;
use App\Model\Users\Seller;
use App\Model\Users\Investor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Gate;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{

    protected $noCodeErrorMessage = "The code is invalid";

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     * tell them to click on email link message
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed|regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[@$!%*#?&<>^*-]).*$/',
        ]);
    }

    /**
     * @method showRegistrationForm
     * @param $UserType
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationForm($UserType)
    
    {
        switch (strtolower($UserType)) {

            case 'admin':
            $seller = 'seller';
            $investors = 'investors';
                return view('auth.register', array('verb' => 'A','UserTypeDescription' => 'admin', 'UserType' => 1),compact('seller','investors'));
            case 'seller':
            $seller = 'seller';
            $investors = 'investors';
                return view('auth.register', array('verb' => 'A','UserTypeDescription' => 'seller', 'UserType' => 2),compact('seller','investors'));
            case 'investors':
            $seller = 'seller';
            $investors = 'investers';
                return view('auth.register', array('verb' => 'AN','UserTypeDescription' => 'investor', 'UserType' => 3),compact('seller','investors'));
            case 'investers':
            $seller = 'seller';
            $investors = 'investers';
                return view('auth.register', array('verb' => 'AN','UserTypeDescription' => 'investor', 'UserType' => 3),compact('seller','investors'));
        }

    }

    /**
     * @method register
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return redirect(route('confirmation'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\Model\Users\User
     */
    protected function create(array $data)
    {
        try {

            $user = User::create([
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'activation_code' => str_random(30) . time(),
                'user_type' => $data['UserType']
            ]);

            $user->notify(new UserRegisteredSuccessfully($user));


        } catch (\Exception $exception) {

            logger()->error($exception);

            return redirect()->back()->with('message', 'Unable to create new user.');

        }


    }

    /**
     * Activate the user with given activation code.
     * @param string $activationCode
     * @return string
     */
    public function activateUser(string $activationCode)
    {



        $user = User::with('seller', 'investor')->where('activation_code', $activationCode)->first();

        if (!$user) {

            return $this->noCodeErrorMessage;

        }

        $user->status = 1;
        $user->activation_code = 'activated';
        $user->save();
        $this->createAccountBalance($user);

        switch ($user->user_type) {
            case 1:

                return $this->roleAttachAdmin($user);

                break;
            case 2:
                return $this->roleAttachSeller($user);
                break;
            case 3:
                return $this->roleAttachInvestor($user);
                break;
        }


        try {



        } catch (\Exception $exception) {

            logger()->error($exception->getMessage());

            return redirect()->back()->with('message', 'Unable to assign the user role.');
        }


    }


    /**
     * @emthod Confirmation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Confirmation()
    {

        return view('auth.confirmation');

    }

    /**
     * @method roleAttachSeller
     * @param $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function roleAttachSeller($user)
    {
        $user->setGuard('web');

        $user->assignRole('seller');

        $user->approved = 0;

        $user->save();


        return redirect()->to('/full-registration-seller')->with('message', 'Account successfully activated');
    }


    /**
     * @method roleAttachInvestor
     * @param $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function roleAttachInvestor($user)
    {
        $user->setGuard('web');
        $user->assignRole('investor');

        $user->approved = 0;

        $user->save();


        return redirect()->to('/full-registration-investor')->with('message', 'Account successfully activated');
    }


    /**
     * @method roleAttachInvestor
     * @param $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function roleAttachAdmin($user)
    {

        $user->setGuard('web');
        $user->assignRole('admin');
        $user->approved = 1;
        $user->save();


        return redirect()->to('/admin')->with('message', 'Account successfully activated');
    }


    public function createAccountBalance(User $user){
        $user->balance()->create();
    }

    /**
     * Send activation code to user's email
     * @param User $user
     * @return back
     */
    public function sendActivationCode(User $user){
        if($user->exists()){
            $user->notify(new UserRegisteredSuccessfully($user));
            return redirect()->back()->withMessage("Activation code was sent again! check $user->email");
        }
        else{
            return response('User does not exist!',404);
        }

    }
}
