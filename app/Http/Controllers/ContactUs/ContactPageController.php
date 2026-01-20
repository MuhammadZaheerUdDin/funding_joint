<?php

namespace App\Http\Controllers\ContactUs;

use App\Http\Requests\ContactUsRequest;
use App\Mail\ContactUs;
use App\Model\Users\User;
use App\Notifications\ContactFormNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactPageController extends Controller
{
    public function sendEmail(ContactUsRequest $request){

        $data = $request->except('_token');

        Mail::send('emails.contactus', $data, function ($message) use ($data){

            $message->from($data['email'],$data['name']);

            $message->to(env('ADMIN_RECEIVE_EMAIL'))->subject('Funding Joint Contact');
        });
        return redirect()->back()->with(['msg' => 'Message was sent successfully!']);
    }
}
