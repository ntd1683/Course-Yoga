<?php

namespace App\Http\Queries;

use App\Http\Requests\CourseFilterRequest;
use Illuminate\Database\Eloquent\Builder;

class CourseFilterQuery
{
    public function __construct(public CourseFilterRequest $request)
    {
    }

    public function apply(Builder $query)
    {
        if ($this->request->query('q')) {
            $query->where('title', 'like', '%' . $this->request->query('q') . '%');
        }

        if ($this->request->query('filter') == 0) {
            $query->orderByDesc('created_at');
        } else if ($this->request->query('filter') == 1) {
            $query->orderBy('title');
        } else if ($this->request->query('filter') == 2) {
            $query->orderByDesc('title');
        }

        if($this->request->query('user') == 1) {
            $arrCourseId = [];
            $myCourse = auth()->user()->manageSubscribe;
            foreach ($myCourse as $course) {
                $arrCourseId[] = $course->id;
            }
            $query->whereIn('id', $arrCourseId);
        }

        return $query;
    }
}
