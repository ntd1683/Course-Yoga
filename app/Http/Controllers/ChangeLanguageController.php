<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChangeLanguageController extends Controller
{
    public function __invoke(string $language)
    {
        \Session::put('website_language', $language);

        return redirect()->back();
    }
}
