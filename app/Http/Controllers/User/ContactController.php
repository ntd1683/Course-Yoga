<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('contact.user.index');
    }

    public function send(ContactRequest $request): RedirectResponse
    {
        try {
            Contact::create([
                ...$request->validated(),
            ]);
            return redirect()->route('index')->with('success', 'Send feedback successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Error Unknown');
        }
    }
}
