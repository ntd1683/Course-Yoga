<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    public function __invoke()
    {
        return view('index');
    }
}
