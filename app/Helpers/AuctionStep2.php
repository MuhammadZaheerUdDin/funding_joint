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
use Illuminate\Support\Facades\Storage;
use Zofe\Rapyd\Facades\DataForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class AuctionStep2
{
    public static function setData($buyer_id) {


        // rename file to PO number with correct extension
        if(Input::hasFile('po_document')){
            $ext = Input::file('po_document')->getClientOriginalExtension();
            $file = rand(11111, 99999) ;
          //  $file = $_POST['po_number'];
            $file_name = $file.'.'.$ext;
            Storage::disk('purchase_orders')->put($file,$file_name); 
        }else{
            $ext=NULL;
            $file_name=NULL;
        }


        $form = DataForm::source(new Auction);

        $form->errors([
                'po_number.max'=>'Po Number cannot be more than 11 digits',
                'po_number.integer'=>'Po Number should be an integer',
                'total_amount_of_po.integer'=>'Total should be an integer',
                'total_amount_of_po.max'=>'Total cannot be more than 11 digits'
            ]
        );
        $form->add('user_id','','hidden')->insertValue(Auth::id());
        $form->add('buyer_id','','hidden')->insertValue($buyer_id);
        $form->add('po_number','','text')->rule('required|integer|max:99999999999');
        $form->add('po_file_name','','text')->insertValue($file_name);
        $form->add('po_document','PO Document', 'file')->move('purchase_orders/',$file_name);
        $form->add('total_amount_of_po','','text')->rule('required|interger|between:1,10');
        $form->add('amount_funding_required','','text')->rule('required|integer');
        $form->add('maximum_discount_limit','','text')->rule('required|integer');
        $form->add('agency_fee','','text');
        $form->add('funding_joint_fee','','text');
        $form->add('net_funding_available','','text');
        $form->add('percentage_invoice','','text');
        $form->add('why_require_funding','','textarea')->rule('required|max:500');
        $form->submit('NEXT');


        $form->saved(function () use ($form) {

            $auction_id = Auction::select()->where('user_id',Auth::id())->get()->last();

            header("location:/create-auction-step-3/3/" . $auction_id->id);

        });
        $form->build();

        if ($form->hasRedirect()) {

            $auction_id = Auction::select()->where('user_id',Auth::id())->get()->last();

            header("location:/create-auction-step-3/3/" . $auction_id->id);

        }

        return $form;

    }

}
