<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Admin\AdminTransactionsController;
use App\Model\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountBalanceController extends Controller
{
    /**
     * @description Remove funds from users balance
     * @param $user
     * @param $amount
     * @return mixed
     */
    public static function debit($user, $amount)
    {
        $amt=$user->balance->balance - $amount;
        // $user->balance->where('user_id',Auth::user()->id)->update([
            // print("User"); print_r($user);
            // print("Amt");print($amt); 
            // print("Bal"); print($user->balance->balance);
            // print("Amount"); print($amount);   
            // die;
        $user->balance->where('user_id',$user->id)->update([
            'balance' => $amt
        ]);

        return $user->balance_amount;

    }


    /**
     * @description Add funds to users balance
     * @param $user
     * @param $amount
     * @return mixed
     */
    public static function credit($user, $amount)
    {

        $amt=$user->balance->balance += $amount; 
        // print("User"); print_r($user);
        //  print("Amt");print($amt); 
        //  print("Bal"); print($user->balance->balance);
        //  print("Amount"); print($amount);   
        //  die;

        $user->balance->where('user_id',$user->id)->update([
            'balance' => $amt
        ]);

        return $user->balance_amount;

    }

    public static function currentBalance($user)
    {
        return $user->balance_amount;

    }


}
