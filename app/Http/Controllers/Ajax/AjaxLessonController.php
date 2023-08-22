<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Trait\ResponseTrait;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class AjaxLessonController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $lessons = Lesson::query();
        return DataTables::of($lessons)
            ->editColumn('title', function ($object) {
                return [
                    'title' => $object->title,
                    'value' => Str::limit($object->title, 20),
                ];
            })
            ->editColumn('view', function ($object) {
                return $object->view ?: 0;
            })
            ->addColumn('author', function ($object) {
                return $object->author()->first()->name ?? '';
            })
            ->addColumn('destroy', function ($object) {
                return route('admin.ajax.lesson.destroy', $object);
            })
            ->addColumn('edit', function ($object) {
                return route('admin.lesson.edit', $object);
            })
            ->make(true);
    }

    public function title(Request $request): array|Collection
    {
        return Lesson::query()->where('title', 'like', '%' . $request->get('q') . '%')->get();
    }

    public function destroy(Lesson $lesson): JsonResponse
    {
        if (auth()->user()->level !== 3 && $lesson->author !== auth()->user()->id) {
            return $this->errorResponse(trans('You do not have permission to delete this lesson !'));
        }

        $lesson->delete();

        return $this->successResponse('', trans('Delete Lesson Successfully'));
    }
}
