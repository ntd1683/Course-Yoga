<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Trait\ResponseTrait;
use App\Models\Course;
use App\Models\SubcriptionCourse;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
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

    public function course(Request $request): array|Collection
    {
        $q = $request->get('q');
        $arrId = SubcriptionCourse::query()->pluck('course_id');
        return Course::query()
            ->whereIn('id', $arrId)
            ->where('title', 'like', '%' . $q . '%')
            ->get();
    }

    public function name(Request $request): array|Collection
    {
        $q = $request->get('q');
        $arrId = SubcriptionCourse::query()->pluck('user_id');
        return User::query()
            ->whereIn('id', $arrId)
            ->where('name', 'like', '%' . $q . '%')
            ->get();
    }

    public function email(Request $request): array|Collection
    {
        $q = $request->get('q');
        $arrId = SubcriptionCourse::query()->pluck('user_id');
        return User::query()
            ->whereIn('id', $arrId)
            ->where('email', 'like', '%' . $q . '%')
            ->get();
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
