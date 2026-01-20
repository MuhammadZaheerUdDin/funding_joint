<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 10/17/2018
 * Time: 3:13 PM
 */

namespace App\Http\Controllers\Search\Filters;


use App\Interfaces\Filter;
use Illuminate\Database\Eloquent\Builder;

class AuctionCredit implements Filter
{

    /**
     * @param Builder $builder
     * @param mixed $value
     * @return Builder
     */
    public static function apply(Builder $builder, $value)
    {


        if(strlen($value) > 0 ){

            return $builder
                ->whereHas('User', function($q) use($value){
                    $q->join('sellers', 'users.id', '=', 'sellers.user_id')
                        ->where('first_name', 'LIKE', '%'.$value.'%')
                        ->orWhere('last_name', 'LIKE', '%'.$value.'%');
                })
                ->orWhereHas('User', function($q) use($value){
                    $q->join('investors', 'users.id', '=', 'investors.user_id')
                        ->where('first_name', 'LIKE', '%'.$value.'%')
                        ->orWhere('last_name', 'LIKE', '%'.$value.'%');
                });


        }


    }

}