<?php

namespace App\Http\Controllers\Frontend;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class SendEmailController extends Controller
{
    /*then you cane use this commad php artisan make:mail SendEmail*/

    public function index(){
        return view('fontend.pages.contact_us');
    }

    public function send(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

    $data = array(
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'message' => $request->message,
    );
    Mail::to('eknojorbd88@gmail.com')->send(new SendMail($data));
    return back()->with('success','Thanks for contact us!!');

    }



}
