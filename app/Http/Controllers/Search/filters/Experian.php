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

class Experian implements Filter
{
    const column = 'experian_rating';

    /**
     * @param Builder $builder
     * @param mixed $value
     * @return Builder
     */
    public static function apply(Builder $builder, $value)
    {


        if(strlen($value) > 0 ){

            switch ($value){
                case 'all':
                    return $builder;
                    break;
                case 'Excellent':
                    return   $builder->whereHas('seller', function($q) use($value){
                        $q->where(self::column, '=', $value);
                    })->orWhereHas('buyer', function($q) use($value){
                        $q->where(self::column, '=', $value);
                    });
                    break;
                case 'Good':
                    return  $builder->whereHas('seller', function($q) use($value){
                        $q->where(self::column, '=', $value);
                    })->orWhereHas('buyer', function($q) use($value){
                        $q->where(self::column, '=', $value);
                    });
                    break;
                case 'Fair':
                    return  $builder->whereHas('seller', function($q) use($value){
                        $q->where(self::column, '=', $value);
                    })->orWhereHas('buyer', function($q) use($value){
                        $q->where(self::column, '=', $value);
                    });
                    break;

                case 'Poor':
                    return  $builder->whereHas('seller', function($q) use($value){
                        $q->where(self::column, '=', $value);
                    })->orWhereHas('buyer', function($q) use($value){
                        $q->where(self::column, '=', $value);
                    });
                    break;

                case 'Very Poor':
                    return  $builder->whereHas('seller', function($q) use($value){
                        $q->where(self::column, '=', $value);
                    })->orWhereHas('buyer', function($q) use($value){
                        $q->where(self::column, '=', $value);
                    });
                    break;

                default:
                    return $builder;

            }


        }


    }

}