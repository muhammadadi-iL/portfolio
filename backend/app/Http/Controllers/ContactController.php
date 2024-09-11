<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Setting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function contact(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('front.contact');
    }

    public function contactForm(Request $request): JsonResponse
    {
        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $message = $request->input('message');

        Contact::create([
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message
        ]);

        $emailMessage = view('front.email.contact', compact('name','phone', 'email', 'subject', 'message'));
        $setting = Setting::find(1);
        $adminEmail = $setting->email;

        send_mail($adminEmail, $subject, $emailMessage);

        return response()->json([
            'success' => true,
            'response' => "Thank you for contacting us we will get back to you shortly.",
        ], 200);
    }
}
