<?php

namespace App\Http\Controllers\Admin;
use App\Model\Admin\AdminSettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    //


    public function index()
    {

        $form = \DataForm::source(AdminSettings::find(1));

        $form->text('minimum_auction_length','Minimum Auction Length (days)')->rule('required|numeric');
        $form->text('maximum_auction_length','Maximum Auction Length (days)')->rule('required|numeric');
        $form->text('maximum_discount_limit','Maximum Discount Limit (%)')->rule('required|numeric');
        $form->text('maximum_time_to_invoice','Maximum Time To Invoice (days)')->rule('required|numeric');
        $form->text('maximum_invoice_issue','Maximum Invoice Term (days)')->rule('required|numeric');
        $form->text('po_settings','Maximum P.O. Funding (%)')->rule('required|numeric');
        $form->text('funding_joint_admin_fee','Funding Joint Admin Fee (%)')->rule('required|numeric');
        $form->text('agency_fee','Agency Fee (%)')->rule('required|numeric');
        $form->text('maximum_expected_roi','Maximum Expected ROI (%)')->rule('required|numeric');
        $form->text('minimum_bid_amount','Minimum Bid Amount (£)')->rule('required|numeric');
        $form->text('minimum_expected_invoice_term','Minimum Expected Invoice Term (days)')->rule('required|numeric');

        $form->submit('Save');
        $form->saved(function() use ($form)
        {
            $form->message("ok settigns saved");
            $form->link("/settings","Back to settings");
        });

        $form->build();

        return view('admin.settings.index', compact('form'));
    }


    public static function getMaximumAuctionLength(){
        return AdminSettings::pluck('maximum_auction_length')->first();
    }

    /**
     * Get settings via ajax request
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiSettings(Request $request){
        $data= $request->data;
        $setting = AdminSettings::first();

        if(!empty($data)){
            return response()->json($setting[$data]);
        }
        else
            return response()->json($setting);

    }
}
