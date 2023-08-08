<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function __invoke()
    {
        return view('course.user.index');
    }
}
