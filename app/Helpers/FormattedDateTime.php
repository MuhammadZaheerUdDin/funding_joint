<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 19/11/2018
 * Time: 12:17
 */

namespace App\Helpers;


use Carbon\Carbon;

class FormattedDateTime
{
    public static function format($date, $format = "d/m/y H:i:s")
    {
        if (!is_null($date)) {
            return Carbon::parse($date)->format($format);
        }
    }
}