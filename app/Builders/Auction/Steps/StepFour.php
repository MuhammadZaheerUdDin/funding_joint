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

class StepFour implements StepsBuilderInterface
{


    public function generate()
    {

        return [

            'auction_form' => $this->getTheAuctionForm(),
            'buyer_form' => $this->getTheBuyerForm(),
            'funding_period_form' => $this->getTheFundingPeriodForm()

        ];

    }


    private function getTheBuyerForm()
    {
        $crud = new BuyerCrud();

        $form = $crud->update();

        return $form;

    }


    private function getTheAuctionForm()
    {
        $crud = new AuctionCrud();
        return $crud->update();

    }


    private function getTheFundingPeriodForm()
    {
        $crud = new AuctionCrud();
        
        $form =  $crud->updateFundingPeriod();


        return $form;

    }


}
