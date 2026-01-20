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

class TransactionSort implements Filter
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

                case 'Internal':
                    return $builder->where('auction_id', '!=', '');
                    break;

                case 'External':
                    return $builder->where('auction_id', '=', NULL);
                    break;
            }


        }


    }

}