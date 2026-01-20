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

class Title implements Filter
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
                ->whereHas('seller', function($q) use($value){
                    $q->where('first_name', 'LIKE', '%'.$value.'%')->orWhere('last_name', 'LIKE', '%'.$value.'%');
                })
                ->orWhereHas('investor', function($q) use($value){
                    $q->where('first_name', 'LIKE', '%'.$value.'%')->orWhere('last_name', 'LIKE', '%'.$value.'%');
                });


        }


    }

}