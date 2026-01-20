<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 15/11/2018
 * Time: 11:18
 */

namespace App\Http\Controllers\Search\Filters;

use App\Interfaces\Filter;
use Illuminate\Database\Eloquent\Builder;
use phpDocumentor\Reflection\Types\Self_;

class CreditLimit implements Filter
{
    const column = 'credit_limit';

    public static function apply(Builder $builder, $value)
    {
        if (strlen($value) > 0) {

            switch (intval($value)) {
                case 1000:
                    return $builder->whereHas('seller', function ($q) use ($value) {
                        $q->where(self::column, '<', $value);
                    });
                    break;
                case 10000:
                    return $builder->whereHas('seller', function ($q) use ($value) {
                        $q->whereBetween(self::column, [1000, 10000]);
                    });
                    break;
                case 50000:
                    return $builder->whereHas('seller', function ($q) use ($value) {
                        $q->whereBetween(self::column, [10000, 50000]);
                    });
                    break;
                case 60000:
                    return $builder->whereHas('seller', function ($q) use ($value) {
                        $q->where(self::column, '>', 50000);
                    });
                    break;
                default:
                    return $builder;
            }

        }
    }
}