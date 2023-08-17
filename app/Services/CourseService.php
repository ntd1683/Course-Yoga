<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\View\View;

class CourseService
{
    public function getClass($courses)
    {
        foreach ($courses as $course) {
            $course->count = $course->manageSubscriber()->count();
        }

        foreach ($courses as $course) {
            if ($course->count > 0) {
                $course->class = " buy";
            }

            if($course->type == 0) {
                $course->class .= " free";
            } else {
                $course->class .= " premium";
            }
        }

        return $courses;
    }
}
