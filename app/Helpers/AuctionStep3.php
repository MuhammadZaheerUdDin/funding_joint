<?php
/**
 * Created by PhpStorm.
 * User: gavin
 * Date: 22/10/18
 * Time: 11:01
 */

namespace App\Helpers;
use App\Model\Auction\Auction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Zofe\Rapyd\Facades\DataEdit;
use Zofe\Rapyd\Facades\DataForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class AuctionStep3
{

    public static function setData($auction_id)
    {


        $days = array(
            '30'=> '30 days',
            '60' => '60 Days',
            '90' => '90 Days',
            '120' => '120 Days'
            );

        $form = DataForm::source(Auction::find($auction_id));

        $form->errors([
                'expected_invoice_term.min'=>'Expected Invoice Term cannot be less than 14',
            ]
        );

        $form->add('expected_invoice_issue_date','','text')->rule('required');
            //->format('d/m/Y', 'uk');
        $form->add('expected_invoice_term','','number')->rule('min:14');
        $form->add('date_repayment_due','','hidden')->rule('required');

        $form->submit('NEXT');


        $form->saved(function () use ($form,$auction_id) {

            header("location:/create-auction-step-4/4/" . $auction_id);

        });
        $form->build();

        if ($form->hasRedirect()) {

            header("location:/create-auction-step-4/4/" . $auction_id);

       }


        return $form;

    }

}