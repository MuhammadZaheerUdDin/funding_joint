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

class AuctionStatus implements Filter
{

    const column = "approved";
    /**
     * @param Builder $builder
     * @param mixed $value
     * @return Builder
     */
    public static function apply(Builder $builder, $value)
    {

        //	0 = Pending, 1 = Approved, 2 = Declined

        if(strlen($value) > 0 ){

            switch ($value){

                case 'all':
                    return $builder;
                    break;

                case 'live':
                    return $builder->where(self::column, 1)->IsLive();
                    break;

                case 'pending':
                    return $builder->where(self::column, 0);
                    break;

                case 'complete':
                    //is Complete when amount_total_funded >= funding required
                    return $builder->EndedAuctions();
                    break;
                case 'successfull':
                    //is Complete when ended and paid back
                    return $builder->SuccessfullAuctions();
                    break;

                case 'unsuccessfull':
                    //is unsuccessfull when ended and not paid back
                    return $builder->UnSuccessfullAuctions();
                    break;
            }


        }


    }

}