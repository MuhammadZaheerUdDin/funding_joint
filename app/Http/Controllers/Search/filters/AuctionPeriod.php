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
class AuctionPeriod implements Filter
{


      const column = "expected_invoice_term";


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
                case 'all':
                    return $builder;
                    break;
                case '30':
                    return $builder->where(self::column, '=', $value);
                    break;
                case '60':
                    return $builder->where(self::column, '=', $value );
                    break;
                case '90':
                    return $builder->where(self::column, '=', $value);
                    break;
                default:
                    return $builder;
            }

        }


    }

}