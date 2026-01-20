<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 15/11/2018
 * Time: 11:54
 */

namespace App\Http\Controllers\Search\Filters;

use App\Interfaces\Filter;
use Illuminate\Database\Eloquent\Builder;

class AuctionWithInvoice implements Filter
{
    const relation = 'invoice';
    public static function apply(Builder $builder, $value)
    {
        if (strlen($value) > 0) {
            if ($value == true)
                return $builder->whereHas(self::relation);
            else
                return $builder;
        }
    }
}