<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 2/19/2019
 * Time: 2:12 PM
 */

namespace App\Crud\Auction;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Zofe\Rapyd\Facades\DataForm;
use Illuminate\Support\Facades\Storage;
use App\Model\Auction\Auction;
use App\Helpers\AuctionSettings;

class AuctionCrud
{

    protected $user;

    protected $buyer_id;

    protected $fileName;

    protected $auction;



    public function __construct($buyer_id = null)
    {
        $this->user = Auth::user();

        $this->buyer_id = $this->getBuyerID();

        if(isset($buyer_id)){

            $this->buyer_id = $buyer_id;

        }


    }


    public function create(){
        $request = Request::capture();

        $form = DataForm::source(new Auction);

        $this->onAttachTheFileName($request);

        $form->errors([
                'po_number.max'=>'Po Number cannot be more than 11 digits',
                'po_number.integer'=>'Po Number should be an integer',
                'total_amount_of_po.integer'=>'Total should be an integer',
                'total_amount_of_po.max'=>'Total cannot be more than 11 digits',
                'po_document.required'=>'The P.O Document is required'
            ]
        );

         $form->attributes(['id' => 'step2']);

        $form->add('user_id','','hidden')->insertValue($this->user->id);

        $form->add('buyer_id','','hidden')->insertValue($this->buyer_id);

        $form->add('po_number','','text')->rule('required');
        $text =  rand(11111, 99999).".xls"; 
        $form->add('po_file_name','','text')->insertValue($text);

        //print_r(storage_path());die;
        $form->add('po_document','', 'App\Inputs\FileInput')
            ->move(storage_path()."/app/public/purchase_orders/", $text);
        // $file = $request->file('po_document');
        // $ext = $file->getClientOriginalExtension();
        // $auction = $request['auction_id'];
        // $date = time();

        // $fileName = $text.'.'.$ext;

        //Storage::disk('purchase_orders')->put($text, file_get_contents(Input::file('po_document')));

        //print_r($this->text); die;
        $form->add('total_amount_of_po','','text');

        $form->add('amount_funding_required','','text');

        $form->add('maximum_discount_limit','','text')->rule('required|integer');

        $form->add('agency_fee','','text')->attributes([
            'readonly' => true,
           
        ]);
        $form->add('percentage_invoice','','text');

        $form->add('funding_joint_fee','','text')->attributes([
          
            'readonly' => true,
           
        ]);

        // $form->add('funding_joint_fee_duplicate','','text')->attributes([
        //     'id' => 'funding_joint_fee',
        //     'value' => '',
        //     'readonly' => true,
           
        // ]);


//        $form->add('net_funding_available','','text');

        $form->add('net_funding_available_duplicate','','text')->attributes([
            'id' => 'net_funding_available',
            'readonly' => true,
        ]);

        $form->add('net_funding_available','','text')->attributes([
            'id' => 'net_funding_available_original',
            'class' => 'd-none',
            'value' => '',
        ]);

        $form->add('percentage_invoice_duplicate','','text')->attributes([
            'id' => 'percentage_invoice',
            'value' => '',
           
        ]);

        $form->add('why_require_funding','','textarea')->rule('required|max:500');


        $form->submit('NEXT','BL',['id' => 'submit' , 'disabled' => 'disabled','title'=>'You will be able to edit these details in Step 4 if required.']);

        //set the auction
        Auction::created(function ($auction){
            $this->auction = $auction;
            session(['auction_id' => $auction->id,'buyers_id'   => $auction->buyer_id]);

        });

        //print_r($form);die;

        //after the save please redirect
        $form->saved(function () use ($form, $request) {

            return redirect()->to("step-3");

        });

        return $form;

//         $request = Request::capture();

//         //print_r($request);die;

//         $form = DataForm::source(new Auction);

//         $this->onAttachTheFileName($request);

//         $form->errors([
//                 'po_number.max'=>'Po Number cannot be more than 11 digits',
//                 'po_number.integer'=>'Po Number should be an integer',
//                 'total_amount_of_po.integer'=>'Total should be an integer',
//                 'total_amount_of_po.max'=>'Total cannot be more than 11 digits',
//                 'po_document.required'=>'The P.O Document is required'
//             ]
//         );

//         $form->add('user_id','','hidden')->insertValue($this->user->id);

//         $form->add('buyer_id','','hidden')->insertValue($this->buyer_id);

//         $form->add('po_number','','text')->rule('required');
//         $text =  rand(11111, 99999);
//         $form->add('po_file_name','','text')->insertValue($this->fileName.$text);

//         $form->add('po_document','PO Document', 'App\Inputs\FileInput')
//             ->move(public_path()."/purchase_orders/", $this->fileName.$text)
//             ->attributes(['id' => 'po_document']);
//         $form->add('total_amount_of_po','','text')->rule('required|integer');

//         $form->add('amount_funding_required','','text')->rule('required|integer');

//         $form->add('maximum_discount_limit','','text')->rule('required|integer|max:20');

//         $form->add('agency_fee','','text');

//         $form->add('funding_joint_fee','','text');

// //        $form->add('net_funding_available','','text');

//         $form->add('net_funding_available_duplicate','','text')->attributes([
//             'id' => 'net_funding_available',
//             'readonly' => true,
//         ]);

//         $form->add('net_funding_available','','text')->attributes([
//             'id' => 'net_funding_available_original',
//             'class' => 'd-none',
//             'value' => '',
//         ]);

//         $form->add('percentage_invoice_duplicate','','text')->attributes([
//             'id' => 'percentage_invoice',
//             'value' => '',
           
//         ]);

//         $form->add('percentage_invoice','','text')->attributes([
//             'id' => 'percentage_invoice_original',
//             'class' => 'd-none',
//             'value' => '',
//         ]);

//         $form->add('why_require_funding','','textarea')->rule('required|max:500');

//         $form->submit('NEXT');


//         //set the auction
//         Auction::created(function ($auction){

//             $this->auction = $auction;
//             session(['auction_id' => $auction->id,
//                     'buyers_id'   => $auction->buyer_id
//                     ]);

//         });

//         //after the save please redirect
//         $form->saved(function () use ($form, $request) {

//             return redirect()->to("step-3");

//         });

//         return $form;


    $request = Request::capture();
        
        $form = DataForm::source(new Auction);

        $this->onAttachTheFileName($request);

        $form->errors([
                'po_number.max'=>'Po Number cannot be more than 11 digits',
                'po_number.integer'=>'Po Number should be an integer',
                'total_amount_of_po.integer'=>'Total should be an integer',
                'total_amount_of_po.max'=>'Total cannot be more than 11 digits',
                'po_document.required'=>'The P.O Document is required'
            ]
        );

        $form->add('user_id','','hidden')->insertValue($this->user->id);

        $form->add('buyer_id','','hidden')->insertValue($this->buyer_id);

        $form->add('po_number','','text')->rule('required');
        $text =  rand(11111, 99999);
        $form->add('po_file_name','','text')->insertValue($this->fileName.$text);

        $form->add('po_document','PO Document', 'App\Inputs\FileInput')
            ->move(public_path()."/purchase_orders/", $this->fileName.$text);

            error_reporting(0);

        $form->add('total_amount_of_po','','text');

        $form->add('amount_funding_required','','text');

        $form->add('maximum_discount_limit','','text')->rule('required|integer|max:20');

        $form->add('agency_fee','','text');

        $form->add('funding_joint_fee','','text');

//        $form->add('net_funding_available','','text');

        $form->add('net_funding_available_duplicate','','text')->attributes([
            'id' => 'net_funding_available',
            'readonly' => true,
        ]);

        $form->add('net_funding_available','','text')->attributes([
            'id' => 'net_funding_available_original',
            'class' => 'd-none',
            'value' => '',
        ]);

        $form->add('percentage_invoice_duplicate','','text')->attributes([
            'id' => 'percentage_invoice',
            'value' => '',
           
        ]);

        $form->add('percentage_invoice','','text')->attributes([
            'id' => 'percentage_invoice_original',
            'class' => 'd-none',
            'value' => '',
        ]);


        $form->add('why_require_funding','','textarea')->rule('required|max:500');


        //$form->submit('NEXT');
        $form->submit('NEXT','BL',['id' => 'submit' , 'disabled' => 'disabled','title'=>'You will be able to edit these details in Step 4 if required.']);

        //set the auction
        Auction::created(function ($auction){

            $this->auction = $auction;
            session(['auction_id' => $auction->id,'buyers_id'   => $auction->buyer_id]);

        });

        //after the save please redirect
        $form->saved(function () use ($form, $request) {

            return redirect()->to("step-3");

        });

        return $form;

//         $request = Request::capture();

//         //print_r($request);die;

//         $form = DataForm::source(new Auction);

//         $this->onAttachTheFileName($request);

//         $form->errors([
//                 'po_number.max'=>'Po Number cannot be more than 11 digits',
//                 'po_number.integer'=>'Po Number should be an integer',
//                 'total_amount_of_po.integer'=>'Total should be an integer',
//                 'total_amount_of_po.max'=>'Total cannot be more than 11 digits',
//                 'po_document.required'=>'The P.O Document is required'
//             ]
//         );

//         $form->add('user_id','','hidden')->insertValue($this->user->id);

//         $form->add('buyer_id','','hidden')->insertValue($this->buyer_id);

//         $form->add('po_number','','text')->rule('required');
//         $text =  rand(11111, 99999);
//         $form->add('po_file_name','','text')->insertValue($this->fileName.$text);

//         $form->add('po_document','PO Document', 'App\Inputs\FileInput')
//             ->move(public_path()."/purchase_orders/", $this->fileName.$text)
//             ->attributes(['id' => 'po_document']);
//         $form->add('total_amount_of_po','','text')->rule('required|integer');

//         $form->add('amount_funding_required','','text')->rule('required|integer');

//         $form->add('maximum_discount_limit','','text')->rule('required|integer|max:20');

//         $form->add('agency_fee','','text');

//         $form->add('funding_joint_fee','','text');

// //        $form->add('net_funding_available','','text');

//         $form->add('net_funding_available_duplicate','','text')->attributes([
//             'id' => 'net_funding_available',
//             'readonly' => true,
//         ]);

//         $form->add('net_funding_available','','text')->attributes([
//             'id' => 'net_funding_available_original',
//             'class' => 'd-none',
//             'value' => '',
//         ]);

//         $form->add('percentage_invoice_duplicate','','text')->attributes([
//             'id' => 'percentage_invoice',
//             'value' => '',
           
//         ]);

//         $form->add('percentage_invoice','','text')->attributes([
//             'id' => 'percentage_invoice_original',
//             'class' => 'd-none',
//             'value' => '',
//         ]);

//         $form->add('why_require_funding','','textarea')->rule('required|max:500');

//         $form->submit('NEXT');


//         //set the auction
//         Auction::created(function ($auction){

//             $this->auction = $auction;
//             session(['auction_id' => $auction->id,
//                     'buyers_id'   => $auction->buyer_id
//                     ]);

//         });

//         //after the save please redirect
//         $form->saved(function () use ($form, $request) {

//             return redirect()->to("step-3");

//         });

//         return $form;



    }

    public function updateStepThreeInformation(){

        $auction_id = $this->getAuctionID();
        $settings = AuctionSettings::getSettings();

        // print_r('<pre>');
        // print_r($settings[0]['minimum_expected_invoice_term']);
        // exit;

        $expected_invoice_term = $settings[0]['minimum_expected_invoice_term'];

        $form = DataForm::source(Auction::find($auction_id));

        $form->attributes(['id' => 'step3']);

        $form->add('expected_invoice_issue_date','','hidden')->attributes([
            'id' => 'net_funding_available_original', 
        ]);

        $form->add('expected_invoice_term','','number')->rule('min:'.$expected_invoice_term);

        $form->add('date_repayment_due','','hidden')->rule('required');

        //  $form->submit('NEXT');

        $form->submit('NEXT','BL',['id' => 'submit' , 'disabled' => 'disabled','title'=>'You will be able to edit these details in Step 4 if required.']);


        $form->saved(function () use ($form,$auction_id) {

            return redirect()->to("step-4");

        });

        return $form;

    }

    public function updateFundingPeriod(){

        
        $auction_id = session('auction_id');
        $settings = AuctionSettings::getSettings();
        $funding_period_form = DataForm::source(Auction::find($auction_id));

        $funding_date = Carbon::parse($funding_period_form->model->date_repayment_due)->format('d/m/Y');   

        //print_r($funding_date);die;  
        $expected_invoice_term = $settings[0]['minimum_expected_invoice_term'];
        $funding_period_form->add('expected_invoice_issue_date','','hidden');

        $funding_period_form->add('expected_invoice_term','','number')->rule('min:'.$expected_invoice_term);

        $funding_period_form->add('date_repayment_due','','hidden')->rule('required');

        $funding_period_form->submit('SAVE');

        $funding_period_form->saved(function () use ($funding_period_form,$auction_id) {
            Session::flash('msg', 'Funding Period details has been updated');

            return redirect()->back();

        });

        return $funding_period_form; 

    }


    public function editIframe()
    {
        $auction_id = session('auction_id');
        $auction = Auction::find($auction_id);

        return  \DataEmbed::source(url('/auctions/editFrame/'. $auction->id), 'embed2')->build();

    }


    public function update()
    {
        $auction_id = session('auction_id');

        $request = Request::capture();

       
        $auction = Auction::find($auction_id);

        $auction_form = DataForm::source($auction);

        $this->onAttachTheFileName($request);

        $auction_form->errors([
                'po_number.max'=>'Po Number cannot be more than 11 digits',
                'po_number.integer'=>'Po Number should be an integer',
                'total_amount_of_po.integer'=>'Total should be an integer',
                'total_amount_of_po.max'=>'Total cannot be more than 11 digits',
                'po_document.required'=>'The P.O Document is required'
            ]
        );

        $auction_form->add('user_id','','hidden')->insertValue($this->user->id);

        $auction_form->add('buyer_id','','hidden')->insertValue($this->buyer_id);

        $auction_form->add('po_number','','text')->rule('required');

        $auction_form->add('total_amount_of_po','','text')->rule('required');

        $auction_form->add('amount_funding_required','','text')->rule('required');

        $auction_form->add('po_file_name','PO Document', 'App\Inputs\FileInput')
            ->move(public_path()."/purchase_orders/", $this->setFileName($auction_id), true, true);

        $auction_form->add('total_amount_of_po','','text')->attributes([
            'id' => 'total_amount_of_po_original'
        ])->rule('required|integer');

        $auction_form->add('total_amount_of_po_duplicate','','text')->attributes([
            'id' => 'total_amount_of_po',
             'class' => 'd-none',
        ])->rule('required');

        $auction_form->add('amount_funding_required','','text')->attributes([
            'id' => 'amount_funding_required_original',            
        ])->rule('required|integer');
        $auction_form->add('amount_funding_required_duplicate','','text')->attributes([
            'id' => 'amount_funding_required',
            'class' => 'd-none',
        ])->rule('required');

        $auction_form->add('percentage_invoice_duplicate','','text')->attributes([
            'id' => 'edit_percentage_invoice',
            'value' => '',
           
        ]);

        $auction_form->add('percentage_invoice','','text')->attributes([
            'id' => 'percentage_invoice_original',
            'class' => 'd-none',
            'value' => '',
        ]);

        $auction_form->add('maximum_discount_limit','','text')->attributes([
            'id' => 'maximum_discount_limit',
        ])->rule('required|integer');

        $auction_form->add('agency_fee','','text')->rule('required');

        $auction_form->add('funding_joint_fee','','text')->rule('required');

        $auction_form->add('net_funding_available','','text')->rule('required');


        $auction_form->add('net_funding_available_duplicate','','text')->attributes([
            'id' => 'net_funding_available',
            'readonly' => true,
        ]);

        $auction_form->add('net_funding_available','','text')->attributes([
            'id' => 'net_funding_available_original',
            'class' => 'd-none',
            'value' => '',
        ])->rule('required');

        $auction_form->add('why_require_funding','','textarea')->rule('required|max:500');

       // print_r($auction_form);die;
        $auction_form->submit('SAVE');

        if(isset($request->po_number) && $request->po_number != null){
        	$auction->po_number = $request->po_number;
	        $auction->total_amount_of_po = $request->total_amount_of_po;
	        $auction->amount_funding_required = $request->amount_funding_required;
	        $auction->maximum_discount_limit = $request->maximum_discount_limit;
	        $auction->agency_fee = $request->agency_fee;
	        $auction->funding_joint_fee = $request->funding_joint_fee;
	        $auction->net_funding_available = $request->net_funding_available;
	        $auction->why_require_funding = $request->why_require_funding;
	        $auction->save();
        }
        //after the save please redirect
        $auction_form->saved(function () use ($auction_form) {


            Session::flash('msg', 'Auction has been updated');

            return redirect()->back();

        });

     


        return $auction_form;
    }


    /**
     * @return mixed
     */
    public function getBuyerID()
    {
        return Session::get("buyer_id");
    }


    /**
     * @return mixed
     */
    public function getAuctionID()
    {
        return Session::get("auction_id");
    }


    /**
     * @method onAttachTheFileName
     * @param $request
     * @return mixed
     */
    public function onAttachTheFileName($request)
    {

        $this->fileName = false;

        if($request->hasFile("po_file_name")){

            $filename = $request->file('po_file_name')->getClientOriginalName();

            $ext = $request->file('po_file_name')->getClientOriginalExtension();

            $without_ext = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);

            $filename = str_slug(strtolower($without_ext)).'-'.$this->user->id.'-'.time().'.'.$ext;

            $this->fileName =  "/purchase_orders/".$filename;

        }

        return $this;
    }


    public function setFileName($auction_id)
    {
        return 'auction-po-'.$auction_id .'-'.$this->fileName;
    }
}
