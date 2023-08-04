<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    public function __invoke()
    {
        return view('homepage.admin.index');
    }
}
