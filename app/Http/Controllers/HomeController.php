<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Model\Admin\WebsiteContents;
use App\Model\Inquiry;
use App\Mail\ContactUs;
use Illuminate\Support\Facades\Mail;


class HomeController extends Controller
{  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {    $seller = "seller";
        $investors = "investors";
        $admin = "admin";
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function whodata()
    {
        $website_data = WebsiteContents::all();
        return view('homepage.who-we-are',compact('website_data'));
    }
    public function compliance_policy()
    {
        return view('homepage.compliance_policy');
     }

     public function howit()
    {
        $website_data = WebsiteContents::all();
        return view('homepage.how-it-works',compact('website_data'));
     }

     public function faq()
    {
        $faqs = \App\Model\Faq::all();
        return view('homepage.faq', compact('faqs'));
     }
     public function disclaimer()
    {
       // $faqs = \App\Model\Faq::all();
        return view('homepage.disclaimer');
     }
     public function terms()
    {
       // $faqs = \App\Model\Faq::all();
        return view('homepage.terms');
     }
     public function privacy()
    {
       // $faqs = \App\Model\Faq::all();
        return view('homepage.privacy');
     }
     public function contact()
    {
       // $faqs = \App\Model\Faq::all();
        return view('homepage.contact');
     }

     public function storeContactUs( Request $request ) {
        
        /*$validatedData = $request->validate([
            'vName' => 'required',
            'vEmail' => 'required',
            'vSubject' => 'required',
            'vPhoneNumber' => 'required',      
            'tDescription' => 'required',
        ]);*/ 

        /*print_r('<pre>');
        print_r($request->all());
        exit;*/

        if($request->type == 1){
            $type = 'Investor';
        }else{
            $type = 'Seller';
        }

        $inquiry = new Inquiry(); 
        $inquiry->name = $request->name;
        $inquiry->email = $request->email;
        $inquiry->type = $type;
        $inquiry->created_at = date('Y-m-d H:i:s');
        $inquiry->updated_at = date('Y-m-d H:i:s');
        $inquiry->save();
        
        $data = array(
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'subject'=>'New Inquiry',
                    'type'=>$type,
                );

        Mail::send('emails.inquiry', $data, function ($message) use ($data){

            $message->from($data['email'],$data['name']);
            // $message->from('bgoswami57@gmail.com',$data['name']);

            // $message->to('manthan@menloparkworld.com')->subject('Funding Joint Inquiry');
            $message->to(env('ADMIN_RECEIVE_EMAIL'))->subject('Funding Joint Inquiry');
        });
        return redirect()->back()->with(['msg' => 'Message was sent successfully!']);
        
        //Mail::to('bgoswami57@gmail.com')->send(new SendMail($data));
        //Mail::to('manthan@menloparkworld.com')->send(new SendMail($data));
        //Mail::to('bhavin@menloparkworld.com')->send(new SendMail($data));
        //Mail::to('danish@launchpadapps.com.au')->send(new SendMail($data));
        //Mail::to('tim@vanguardrisk.com.au')->send(new SendMail($data));
       
        echo 'Submitted successfully.';
    }
   
     
}
