<?php
/**
 * Created by PhpStorm.
 * User: gavin
 * Date: 22/10/18
 * Time: 11:02
 */

namespace App\Helpers;

use App\Model\Buyer\Buyer;
use App\Model\Auction\Auction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Zofe\Rapyd\Facades\DataEdit;
use Zofe\Rapyd\Facades\DataForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AuctionStep4
{

    /**
     * @param $auction_id
     * @return array
     */
    public static function setData($auction_id)
    {

        // get buyer for this auction
        $Auction = Auction::find($auction_id);

        $buyer = Buyer::find($Auction->buyer_id);

        $buyer_form = DataEdit::source($buyer);


        $buyer_form->errors([
                'po_number.max'=>'Po Number cannot be more than 11 digits',
                'po_number.integer'=>'Po Number should be an integer',
                'total_amount_of_po.integer'=>'Total should be an integer',
                'total_amount_of_po.max'=>'Total cannot be more than 11 digits'
            ]
        );

        //$buyer_form->add('user_id', '', 'hidden')->insertValue(Auth::id());
        $buyer_form->add('company_name', '', 'text')->rule('required|max:50');
        $buyer_form->add('company_registration', '', 'text')->rule('required|max:50');
        $buyer_form->add('company_registration_date', '', 'date');
        $buyer_form->add('turnover', '', 'text')->rule('required');
        $buyer_form->add('address_1', '', 'text')->rule('required|max:250');
        $buyer_form->add('address_2', '', 'text');
        $buyer_form->add('address_3', '', 'text');
        $buyer_form->add('town', '', 'text')->rule('required|max:50');
        $buyer_form->add('county', '', 'text')->rule('required|max:50');
        $buyer_form->add('post_code', '', 'text')->rule('required|max:50');
        $buyer_form->add('company_website', '', 'text')->rule('required|max:50');

        $buyer_form->add('title', '', 'select')->options([
            'Mr',
            'Mrs',
            'Miss',
        ]);

        $buyer_form->add('first_name', '', 'text');

        $buyer_form->add('last_name', '', 'text');

        $buyer_form->add('job_title','','select')->options(OccupationHelper::getOccupations());

        $buyer_form->add('email', '', 'text');
        $buyer_form->add('phone_code', '', 'text')->rule('required');
        $buyer_form->add('phone', '', 'text')->rule('required');

        $buyer_form->saved(function () use ($buyer_form, $auction_id) {

            Session::flash('msg', 'Buyer details has been updated');

            header("location:/step-4/" . $auction_id);

        });

        $buyer_form->build();

    ############### GET AUCTION #########################

        // rename file to PO number with correct extension
        if(Input::hasFile('po_document')){
            $ext = Input::file('po_document')->getClientOriginalExtension();
            $file = $_POST['po_number'];
            $filedoc = Input::file('po_document'); //correcting file upload ( it should work now )
            $file_name = 'auction-'.$auction_id.'-PO-'.$file.'-'.time().'.'.$ext;
            Storage::disk('purchase_orders')->put($file_name,file_get_contents($filedoc));
        }else{
            $ext=NULL;
            $file_name=NULL;
        }

        $auction_form = DataEdit::source(Auction::find($auction_id));

        ///$auction_form->add('user_id','','hidden')->insertValue(Auth::id());
       // $auction_form->add('buyer_id','','hidden')->insertValue($buyer_id);
        $auction_form->add('po_number','','text')->rule('required|integer');
        $auction_form->add('po_file_name','','text')->insertValue($file_name);


// Begin of KK20210824
        // $auction_form->add('po_document','PO Document', 'App\Inputs\FileInput')
        //     ->move(public_path()."/purchase_orders/", $file_name);
        $auction_form->add('po_document','Invoise Document', 'App\Inputs\FileInput')
            ->move(public_path()."/purchase_orders/", $file_name);
// End of KK20210824

        $auction_form->add('total_amount_of_po','','text')->rule('required|integer');
        $auction_form->add('amount_funding_required','','text')->rule('required|integer');
        $auction_form->add('maximum_discount_limit','','text')->rule('required|integer');
        $auction_form->add('agency_fee','','text');
        $auction_form->add('funding_joint_fee','','text');
        $auction_form->add('net_funding_available','','text');
        $auction_form->add('why_require_funding','','textarea')->rule('required|max:500');
       // $auction_form->submit('NEXT');


        $auction_form->saved(function () use ($auction_form, $auction_id) {

            Session::flash('msg', 'Auction details has been updated');
            header("location:/step-4/" . $auction_id);

        });

        $auction_form->build();


        if ($auction_form->hasRedirect()) {
            Session::flash('msg', 'Auction details has been updated');
            header("location:/step-4/" . $auction_id);

        }


        $funding_period_form = DataEdit::source(Auction::find($auction_id));

        $funding_period_form->add('expected_invoice_issue_date','','text')->rule('required');

        $funding_period_form->add('expected_invoice_term','','number')->rule('min:14');
        $funding_period_form->add('indicative_funding_period','','hidden')->rule('required');
        $funding_period_form->add('date_repayment_due','','text')->rule('required');


        $funding_period_form->saved(function () use ($funding_period_form,$auction_id) {

            Session::flash('msg', 'Funding Period details has been updated');

            header("location:/step-4/" . $auction_id);

        });

        $funding_period_form->build();

        if ($funding_period_form->hasRedirect()) {

            Session::flash('msg', 'Funding Period details has been updated');
            header("location:/step-4/" . $auction_id);

        }


        $forms = array('auction_form' => $auction_form,'buyer_form' => $buyer_form,'funding_period_form' => $funding_period_form);

        return $forms;

    }


    public function onGetBuyerForm()
    {
        
    }

}
