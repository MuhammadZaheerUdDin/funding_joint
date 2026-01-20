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

/**
 * Class Amount
 * @package App\Http\Controllers\Search\Filters
 */
class AuctionROI_Amount implements Filter
{


    const column = "maximum_discount_limit";


    /**
     * @param Builder $builder
     * @param mixed $value
     * @return Builder
     */
    public static function apply(Builder $builder, $value)
    {
        $value = intval($value);

        if (strlen($value) > 0) {
            return $builder->where(self::column,'=',$value);
        }

    }

}