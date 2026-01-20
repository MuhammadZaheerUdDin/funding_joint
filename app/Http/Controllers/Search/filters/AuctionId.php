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

class AuctionId implements Filter
{

    /**
     * @method apply
     * @param Builder $builder
     * @param mixed $valueNo Notifications found
     * @return Builder
     */
    public static function apply(Builder $builder, $value)
    {

        if(strlen($value) > 0){

          return $builder->where('auction_id', '=', $value);

        }

    }

}