<?php

namespace App\Http\Controllers\Ajax;

use App\Enums\CourseTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Trait\ResponseTrait;
use App\Models\Course;
use App\Models\ManageCourse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class AjaxCourseController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $course = Course::query();
        return DataTables::of($course)
        ->editColumn('title', function ($object) {
            return [
                'title' => $object->title,
                'value' => Str::limit($object->title, 28),
            ];
        })
        ->editColumn('type', function ($object) {
            return CourseTypeEnum::getKeyByValue($object->type);
        })
        ->editColumn('price', function ($object) {
            return number_shorten($object->price);
        })
        ->editColumn('view', function ($object) {
            return $object->view ?: 0;
        })
        ->addColumn('author', function ($object) {
            return $object->author->name ?? '';
        })
        ->addColumn('destroy', function ($object) {
            return route('admin.ajax.course.destroy', $object);
        })
        ->addColumn('edit', function ($object) {
            return route('admin.course.edit', $object);
        })
        ->make(true);
    }

    public function title(Request $request)
    {
        return Course::query()->where('title', 'like', '%' . $request->get('q') . '%')->get();
    }

    public function destroy(Course $course): JsonResponse
    {
        if (auth()->user()->level !== 3 && $course->author !== auth()->user()->id) {
            return $this->errorResponse(trans('You do not have permission to delete this event !'));
        }

        ManageCourse::query()->where('course_id', $course->id)->first()->delete;

        $course->delete();

        return $this->successResponse('', trans('Delete Event Successfully'));
    }
}
