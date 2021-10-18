<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
   public function send_mail(Request $request){
       $details = [
           'name' => $request->name,
           'email' => $request->email,
           'message' => $request->message
       ];

       Mail::to('htetmyatsoe492@gmail.com')->send(new ContactMail($details));
       return back()->with('message_sent','Your message was sent to Knowledge World Owner.');
   }
}
