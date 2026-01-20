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

class AuctionCompanyName implements Filter
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
                ->whereHas('buyer', function ($query) use ($value){
                    $query->where('company_name', 'like', '%'.$value.'%');
                });

        }


    }

}