<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        return view('course.user.index');
    }

    public function show(Course $course)
    {
        $lessons = $course->lessons()->published()->accepted()->get();
        $totalView = 0;
        foreach ($lessons as $lesson) {
            $totalView += $lesson->view ?: 0;
        }

        return view('course.user.show', compact('course', 'lessons', 'totalView'));
    }
}
