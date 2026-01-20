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

class Files implements Filter
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

                case '0-5':
                    $builder->with('document');
                    break;
                case '5-10':
                     $builder->with('document');
                    break;
                case '10+':
                    $builder->with('document');
                    break;
                default:
                    return $builder;

            }


        }


    }

}