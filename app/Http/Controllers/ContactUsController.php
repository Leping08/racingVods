<?php

namespace App\Http\Controllers;

use App\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactUsController extends Controller
{
    public function store(Request $request)
    {
        $newContactUs = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required|max:5000'
        ]);

        $contactUs = ContactUs::create($newContactUs);

        Log::info("Message sent from: {$contactUs->name}");

        return $contactUs;
    }
}
