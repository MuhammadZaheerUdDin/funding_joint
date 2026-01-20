<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 15/11/2018
 * Time: 11:45
 */

namespace App\Http\Controllers\Search\Filters;

use App\Interfaces\Filter;
use Illuminate\Database\Eloquent\Builder;

class AuctionWithPO implements Filter
{
    const relation = 'po_file_name';

    public static function apply(Builder $builder, $value)
    {
        if (strlen($value) > 0) {
            if ($value == true)
                return $builder->whereNotNull(self::relation);
            else
                return $builder;
        }
    }
}