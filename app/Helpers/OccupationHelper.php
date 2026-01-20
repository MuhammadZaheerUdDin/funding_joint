<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 2/19/2019
 * Time: 1:23 PM
 */

namespace App\Helpers;


class OccupationHelper
{


    /**
     * @method getOccupations
     * @description Print's a list of all the occupations available
     * @return array
     */
    public static function getOccupations()
    {
        $occupations_file = file_get_contents(storage_path() . "/app/public/occupations.json");
        $occupations = json_decode($occupations_file,true);
        return $occupations["occupations"];
    }
}