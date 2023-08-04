<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function __invoke()
    {
        return view('pricing.index');
    }
}
