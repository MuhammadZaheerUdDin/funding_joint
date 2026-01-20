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

class Type implements Filter
{

    /**
     * @param Builder $builder
     * @param mixed $value
     * @return Builder
     */
    public static function apply(Builder $builder, $value)
    {

        if(strlen($value) > 0 ){

            switch ($value){

                case 'All':
                    return $builder;

                case 'Admin':
                    return $builder->where('user_type', 1);
                    break;

                case 'Seller':
                    return $builder->where('user_type', 2);
                    break;

                case 'Investor':
                    return $builder->where('user_type', 3);
                    break;

                default:
                    return $builder;

            }


        }


    }

}