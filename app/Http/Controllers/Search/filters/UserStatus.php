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

class UserStatus implements Filter
{

    const All = "All";
    const News = "New";
    const Approved = "Approved";
    const ToApprove = "ToApprove";
    const Declined = "Declined";


    /**
     * @param Builder $builder
     * @param mixed $value
     * @return Builder
     */
    public static function apply(Builder $builder, $value)
    {
        //print_r($value);die;
        if (strlen($value) > 0) {

            
            switch ($value) {

                case self::All:
                    return $builder;

                case self::News:
                    return $builder->where('is_completed', 0);
                    break;

                case self::Approved:
                    return $builder->where('approved', 1);
                    break;

                case self::Declined:
                    return $builder->where('approved', 2);
                    break;
                case self::ToApprove:
                    return $builder->where('approved', 0)->where('is_completed', 1);
                    break;
                default:
                    return $builder;

            }


        }

    }

}