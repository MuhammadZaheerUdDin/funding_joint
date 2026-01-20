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
class TransactionAmount implements Filter
{


    protected const column = "amount";


    /**
     * @param Builder $builder
     * @param mixed $value
     * @return Builder
     */
    public static function apply(Builder $builder, $value)
    {
        $value = intval($value);

        if (strlen($value) > 0) {

            switch ($value) {
                case 1000:
                    return $builder->where(self::column, '<', $value);
                    break;
                case 10000:
                    return $builder->whereBetween(self::column, [1000, 10000]);
                    break;
                case 50000:
                    return $builder->whereBetween(self::column, [10000, 50000]);
                    break;
                case 60000:
                    return $builder->where(self::column, '>', 50000);
                    break;
                default:
                    return $builder;
            }

        }


    }

}