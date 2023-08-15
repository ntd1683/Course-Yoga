<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Trait\ResponseTrait;
use App\Models\Contact;
use App\Models\Course;
use App\Models\SubcriptionCourse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class AjaxSubscriptionController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $subscription = SubcriptionCourse::query()
            ->select('subcription_courses.*', 'users.name', 'users.email', 'courses.title')
            ->join('users', 'users.id', '=', 'subcription_courses.user_id')
            ->join('courses', 'courses.id', '=', 'subcription_courses.course_id');
        return DataTables::of($subscription)
            ->editColumn('courses.title', function ($object) {
                return [
                    'title' => $object->course()->first()->title,
                    'value' => Str::limit($object->course()->first()->title, 20),
                ];
            })
            ->editColumn('users.name', function ($object) {
                return $object->user()->first()->name;
            })
            ->editColumn('users.email', function ($object) {
                return $object->user()->first()->email;
            })
            ->addColumn('destroy', function ($object) {
                return route('admin.ajax.subscribe.destroy', $object);
            })
            ->addColumn('edit', function ($object) {
                return route('admin.subscribe.edit', $object);
            })
            ->make(true);
    }

    public function course(Request $request)
    {
        $subscription = SubcriptionCourse::query()->with('course');
        $q = $request->get('q');
        return $subscription->whereHas('course', function ($query) use ($q) {
            $query->where('title', 'like', '%' . $q . '%');
        })->get();
    }

    public function name(Request $request)
    {
        $subscription = SubcriptionCourse::query()->with('user');
        $q = $request->get('q');
        return $subscription->whereHas('user', function ($query) use ($q) {
                $query->where('name', 'like', '%' . $q . '%');
            })->get();
    }

    public function email(Request $request)
    {
        $subscription = SubcriptionCourse::query()->with('user');
        $q = $request->get('q');
        return $subscription->whereHas('user', function ($query) use ($q) {
                $query->where('email', 'like', '%' . $q . '%');
            })->get();
    }

    public function destroy(SubcriptionCourse $subscription): JsonResponse
    {
        if (auth()->user()->level !== 3) {
            return $this->errorResponse(trans('You do not have permission to delete this contact !'));
        }

        $subscription->delete();

        return $this->successResponse('', trans('Delete Subscription Successfully'));
    }
}
