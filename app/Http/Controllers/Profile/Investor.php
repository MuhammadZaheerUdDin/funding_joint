<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 14/11/2018
 * Time: 11:31
 */

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Profile\Interfaces\ProfileCompletionRedirect;
use Illuminate\Support\Facades\Auth;

class Investor implements ProfileCompletionRedirect
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function redirect()
    {

        if(!auth()->user()->investor()->exists()){
            return  '/full-registration-investor';
        }
        elseif (!$this->user->bankDetails()->exists()) {
            return '/enter-bank-details';
        }
        elseif(!auth()->user()->identification()->exists()){
            return  '/identity-verification';
        }elseif(!auth()->user()->investor->agree){
            return  '/investor-confirm';
        }


        return '/profile';

    }
}