<?php

/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 14/11/2018
 * Time: 11:26
 */

namespace App\Http\Controllers\Profile\Interfaces;


/**
 * Interface ProfileCompletionRedirect
 * @package App\Http\Controllers\Profile\Interfaces
 */
interface ProfileCompletionRedirect
{
    /**
     * @method redirect
     * @description This interface makes an class implement the redirect based upon the profile type.
     * @return mixed
     */
    public function redirect();

}