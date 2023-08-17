<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Queries\CourseFilterQuery;
use App\Http\Requests\CourseFilterRequest;
use App\Models\Course;
use App\Models\Event;
use App\Services\CourseService;

class CourseController extends Controller
{
    public function __construct(protected CourseService $courseService){}

    public function index(CourseFilterRequest $request, CourseFilterQuery $courseFilterQuery)
    {
        $perPage = $request->get('per_page') ?: 8;
        $courses = $courseFilterQuery->apply(Course::query())->paginate($perPage);
        $courses = $this->courseService->getClass($courses);
        return view('course.user.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $view = $course->view + 1;
        $course->save();
        $lessons = $course->lessons()->published()->accepted()->get();
        $totalView = $view;
        foreach ($lessons as $lesson) {
            $totalView += $lesson->view ?: 0;
        }

        return view('course.user.show', compact('course', 'lessons', 'totalView'));
    }
}
