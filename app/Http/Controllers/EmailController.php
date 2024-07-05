<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;   

class EmailController extends Controller
{
      public function sendEmail(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'organizationName' => 'required',
            'email' => 'required|email',
            'contact' => 'required',
            'selectedOption' => 'required',
        ]);

        // Send email
        Mail::send('contact_form_email', ['data1' => $validatedData], function($m){
            $m->to('bamujonah@gmail.com')->subject('Contact Form Mail');
        });

        return response()->json(['message' => 'Email sent successfully']);
    }
}
