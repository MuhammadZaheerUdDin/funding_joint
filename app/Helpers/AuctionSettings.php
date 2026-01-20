<?php
/**
 * Created by PhpStorm.
 * User: gavin
 * Date: 22/10/18
 * Time: 18:57
 * admin sets these, and they are applied to all auctions
 * each auction uses the settings that were available as time of creating the auction
 * if admin changes settings at a later date these are NOT applied to current auction
 */

namespace App\Helpers;

use Illuminate\Database\Eloquent;
use App\Model\Admin\AdminSettings;

class AuctionSettings
{
    public static function getSettings()
    {
        return AdminSettings::all();
    }

}