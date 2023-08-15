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
use Illuminate\View\View;
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
                'value' => Str::limit($object->title, 20),
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

    public function lessons(Request $request)
    {
        if($request->get('id')) {
            try {
                $course = Course::query()->where('id', $request->get('id'))->first();
                $lessons = $course->lessons()->get();
                $result = view('lesson.partials.list', compact('lessons'))->render();

                return $this->successResponse($result, trans("Successfully"));
            } catch (\Exception $e) {
                return $this->errorResponse(trans("Error Unknown"));
            }
        }

        return $this->errorResponse(trans("Missing Param ID Course"));
    }

    public function users(Request $request)
    {
        if($request->get('course_id')) {
            try {
                $course = Course::query()->where('id', $request->get('course_id'))->first();
                $users = $course->manageSubscriber()->select('user_id as value', 'name', 'email')->get()->toArray();

                return $this->successResponse($users, trans("Successfully"));
            } catch (\Exception $e) {
                return $this->errorResponse(trans("Error Unknown"));
            }
        }

        return $this->errorResponse(trans("Missing Param ID Course"));
    }

    public function destroy(Course $course): JsonResponse
    {
        if (auth()->user()->level !== 3 && $course->author !== auth()->user()->id) {
            return $this->errorResponse(trans('You do not have permission to delete this course !'));
        }

        ManageCourse::query()->where('course_id', $course->id)->first()->delete;

        $course->delete();

        return $this->successResponse('', trans('Delete Course Successfully'));
    }
}
