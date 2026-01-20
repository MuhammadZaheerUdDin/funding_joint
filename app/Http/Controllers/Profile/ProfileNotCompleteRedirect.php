<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 14/11/2018
 * Time: 11:27
 */

namespace App\Http\Controllers\Profile;


use Illuminate\Support\Facades\Auth;

class ProfileNotCompleteRedirect
{

    /**
     * @method index
     * @description Provides an way to redirect the user after he logged in
     * @return bool
     * @throws \Exception
     */
    public static function index()
    {

        $user = Auth::user();

        $role = $user->getRole();

        if($role=='admin'){

            return true;

        }

        $class = __NAMESPACE__ . '\\' . studly_case($role);

        if(class_exists($class)) {

            $class = new $class;

            return $class->redirect();

        }else{

            throw new \Exception('No Profile Completion link  class found for this user');

        }

    }
}