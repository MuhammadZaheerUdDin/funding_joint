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

class StepTwo implements StepsBuilderInterface
{
    protected $buyer_id;

    public function __construct($buyer_id)
    {
        $this->buyer_id = $buyer_id;
    }


    public function generate()
    {
        //init the auction crud
        $crud = new AuctionCrud($this->buyer_id);

        return $crud->create();

    }


}
