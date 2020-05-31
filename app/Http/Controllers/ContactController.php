<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function index()
    {
    	return view('home.contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string|min:20',
        ]);

        $forminput = [
            'name' => $request->input('name'),
            'whatsapp' => $request->input('whatsapp'),
            'email' => $request->input('email'),
            'message' => $request->input('message')
        ];

		Mail::to(env('CONTACT_MAIL'))->send(new ContactMail($forminput));
		flash()->success('¡Mensaje enviado! Gracias por contactarnos.');
        return redirect('contact');
    }
}
