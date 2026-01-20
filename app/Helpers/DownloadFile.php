<?php
/**
 * Created by PhpStorm.
 * User: gmoulton
 * Date: 14/11/2018
 * Time: 10:50
 */

namespace App\Helpers;
use Illuminate\Support\Facades\File;


class DownloadFile
{
    public static function getDownloadLink($path,$filename){

        	//$file 			= url('/'.$path.'/'.$filename.'.');
        $file = storage_path("app/public/$path/$filename");
       
        if(!File::exists($file)) {
            return null;
        } else {
            return $file;
        }
    }

}