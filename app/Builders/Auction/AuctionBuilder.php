<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 2/19/2019
 * Time: 12:44 PM
 */
namespace App\Builder\Auction;

use App\Interfaces\StepsBuilderInterface;

class AuctionBuilder
{

    protected $stepsBuilder;



    public function __construct(StepsBuilderInterface $stepsBuilder)
    {
        $this->stepsBuilder = $stepsBuilder;
    }


    public function generate()
    {
        return $this->stepsBuilder->generate();
    }


}
