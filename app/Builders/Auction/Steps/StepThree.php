<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 2/19/2019
 * Time: 1:58 PM
 */

namespace App\Builders\Auction\Steps;


use App\Crud\Auction\AuctionCrud;
use App\Interfaces\StepsBuilderInterface;
use App\Crud\Auction\BuyerCrud;

class StepThree implements StepsBuilderInterface
{


    public function generate()
    {
        //init the buyer crud
        $crud = new AuctionCrud();

        return $crud->updateStepThreeInformation();

    }


}
