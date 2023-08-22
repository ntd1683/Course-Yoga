<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChangeLanguageController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $language = $request->get('language') ?: 'vi';
        Session::put('lang', $language);

        return redirect()->back();
    }
}
