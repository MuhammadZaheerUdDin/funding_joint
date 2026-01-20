<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 19/11/2018
 * Time: 12:17
 */

namespace App\Helpers;


use Carbon\Carbon;

class FormattedDate
{
    public static function format($date, $format = "d/m/Y")
    {
        if (!is_null($date)) {
            return Carbon::parse($date)->format($format);
        }
    }
}