<?php

namespace App\Http\Controllers\Auction;

use App\Helpers\DownloadFile;
use App\Model\Auction\Auction;
use Illuminate\Http\Request;
use App\Model\Users\Seller;
use App\Model\Users\User;
use Illuminate\Support\Facades\Storage;
use App\Model\Auction\Invoice;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\InvoiceFormRequest;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Admin\NotificationsController;
use App\Notifications\UserNotification;
use App\Notifications\AdminNotification;





class InvoiceController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceFormRequest $request)
    {


        try {
            $invoiceFileName = $this->uploadInvoice($request);

            //print_r($invoiceFileName);die;

            $user = Auth::user();

            $invoice = Invoice::create([
                'user_id'           => $user->id,
                'auction_id'        => $request->auction_id,
                'invoice_file_name' => $invoiceFileName,
                'approved'          => 0
            ]);

            //print_r($invoice);die;
            $auction = Auction::where('id',$request->auction_id);
            $user = Auth::user();
            $not_title = config('notifications.admin.invoice_uploaded');
            //$not_link = route('admin.auctions',$request->auction_id);
            $not_link  = route('auction.details',$request->auction_id);
            $not_body = $user->full_name . ' has uploded the Invoice for Auction #'. $request->auction_id;
            $notification = new AdminNotification($not_title, $not_body, $not_link);
            NotificationsController::sendToAdmins($notification);

            return redirect()->back()->withMessage('Invoice uploaded');

        }  catch (\Exception $exception) {
            echo $exception;die;
            logger()->error($exception);
            return redirect()->back()->with('message', 'Unable to upload file.');

        }



    }

    /**
     * Download invoice
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Request $request,$id){

             
        $document = Invoice::findOrFail($id);

        $path = DownloadFile::getDownloadLink('invoices',$document->invoice_file_name);
       // print_r($path);die;
        if($request->action == 'view')
            return response()->file($path);
        else
            return response()->download($path);
    }

    /**
     * Upload invoice function
     * @param Request $request
     * @return string name of the file uploaded
     */
    public function uploadInvoice(Request $request){

        $file = $request->file('invoice_file');
        $ext = $file->getClientOriginalExtension();
        $auction = $request['auction_id'];
        $date = time();

        $fileName = 'auction-'.$auction.'-PO-'.$date.'.'.$ext;

        Storage::disk('invoices')->put($fileName, file_get_contents(Input::file('invoice_file')));

        return $fileName;
    }




}
