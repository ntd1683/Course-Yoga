<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AjaxUserController extends Controller
{
    public function lecturers() {
        return User::select('id', 'email')
            ->where('level', 2)
            ->get();
    }
}
