<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 14/11/2018
 * Time: 11:27
 */

namespace App\Http\Controllers\Profile;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Profile\Interfaces\ProfileCompletionRedirect;

class Seller implements ProfileCompletionRedirect
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }


    /**
     * @return string
     */
    public function redirect()
    {
        if (!$this->user->seller()->exists()) {
            return '/full-registration-seller';
        } elseif (!$this->user->bankDetails()->exists()) {
            return '/enter-bank-details';
        // } elseif (!$this->user->bankStatement()->exists()) {
        //     return '/upload-bank-statement';
        } elseif (!auth()->user()->seller->agree) {
            return '/seller-confirm';
        }


        return '/profile';

    }

}