<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\NewContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact-us');
    }

    public function store(ContactRequest $request)
    {
        $mail = new NewContact(
            $request->get('email'),
            $request->get('name'),
            $request->get('phone')
        );

        session()->flash('success', 'Successfully!');

        Mail::to('info@dev.com')->send($mail);

        return redirect()->back();
    }
}
