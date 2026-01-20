<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 2/19/2019
 * Time: 1:58 PM
 */

namespace App\Builders\Auction\Steps;


use App\Interfaces\StepsBuilderInterface;
use App\Crud\Auction\BuyerCrud;

class StepOne implements StepsBuilderInterface
{


    public function generate()
    {
        //init the buyer crud
        $crud = new BuyerCrud;
        return $crud->create();
    }


}
