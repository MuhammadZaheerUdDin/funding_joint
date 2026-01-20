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

class SortBy implements Filter
{

    /**
     * @param Builder $builder
     * @param mixed $value
     * @return Builder
     */
    public static function apply(Builder $builder, $value)
    {



        if(strlen($value) > 0){

            switch ($value){

                case 'recent':
                    return $builder->orderBy('created_at', 'DESC');

                case 'oldest':

                    return $builder->orderBy('created_at', 'ASC');

                case 'amount':
                    return $builder->orderBy('amount', 'DESC');

                case 'status':
                    return $builder->orderBy('status', 'ASC');

                default:
                    return $builder;

            }

        }

    }

}