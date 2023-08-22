<?php

namespace App\Http\Controllers\Ajax;

use App\Enums\CourseTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Queries\CourseFilterQuery;
use App\Http\Requests\CourseFilterRequest;
use App\Http\Requests\ImportSheetCoursesRequest;
use App\Http\Trait\ResponseTrait;
use App\Models\Course;
use App\Models\ManageCourse;
use App\Services\CourseService;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Revolution\Google\Sheets\Facades\Sheets;
use Yajra\DataTables\DataTables;

class AjaxCourseController extends Controller
{
    use ResponseTrait;

    public function __construct(protected CourseService $courseService){}

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

    public function title(Request $request): array|Collection
    {
        return Course::query()->where('title', 'like', '%' . $request->get('q') . '%')->get();
    }

    public function lessons(Request $request): JsonResponse
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

    public function users(Request $request): JsonResponse
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

    public function getCourses(CourseFilterRequest $request, CourseFilterQuery $courseFilterQuery): View
    {
        $perPage = $request->get('per_page') ?: 8;
        $courses = $courseFilterQuery->apply(Course::query())->paginate($perPage);
        $courses = $this->courseService->getClass($courses);
        return view('course.user.partials.list', compact('courses'));
    }

    public function getNewCourses(Request $request): JsonResponse
    {
        $type = $request->get('type') ?: 0;
        $courses = Course::query()->where('type', $type)->orderByDesc('created_at')->get();

        $result = view('course.user.partials.list-new-course', compact('courses'))->render();
        return $this->successResponse($result, trans("Get new courses"));
    }

    public function getTopRelate(): JsonResponse
    {
        $courses = Course::all();

        $courses = $courses->sortBy([
            ['count', 'desc'],
            ['view', 'desc'],
        ]);

        $courses = $this->courseService->getClass($courses)->take(8);
        $result = view('course.user.partials.list-relate', compact('courses'))->render();
        return $this->successResponse($result, trans("Get new courses"));
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

    public function importSheet(ImportSheetCoursesRequest $request): JsonResponse
    {
        try {
            $listError = [];

            $sheet = $request->get('sheet');
            $validateLinkSheet = Str::contains($sheet, "https://docs.google.com/spreadsheets/d/");

            if(! $validateLinkSheet) {
                return $this->errorResponse(trans("Google sheet link error is not in the correct format"));
            }

            $arr =  explode('/', $sheet);
            $spreadsheetId = $arr[array_search('d', $arr) + 1];
            $sheet = $request->get('sheet_tab_name');

            $sheets = Sheets::spreadsheet($spreadsheetId)->sheet($sheet)->get();
            $header = $sheets->pull(0);
            $posts = Sheets::collection($header, $sheets);
            $posts = $posts->take(5000);

            $data = $posts->toArray();

            $title = $request->get('name_title') ?: 'Tiêu Đề';
            $description = $request->get('name_description') ?: 'Mô Tả';
            $link_embedded = $request->get('name_link_embedded') ?: 'Link Nhúng';
            $type = $request->get('name_type') ?: 'Loại';
            $price = $request->get('name_price') ?: 'Giá';
            $image = $request->get('name_image') ?: 'Ảnh';
            $view = $request->get('name_view') ?: 'Lượt Xem';

            foreach ($data as $key => $value) {
                $tmp = [
                    'title' => $value[$title],
                    'description' => $value[$description],
                    'link_embedded' => $value[$link_embedded],
                    'type' => $value[$type],
                    'price' => $value[$price],
                    'image' => $value[$image],
                    'view' => $value[$view],
                ];

                $validator = Validator::make($tmp, [
                    'title' => ['required', 'string', Rule::unique(Course::class, 'title')],
                    'description' => ['required','string'],
                    'link_embedded' => ['required', 'string'],
                    'type' => [Rule::in(CourseTypeEnum::asArray())],
                    'price' => ['nullable', 'string'],
                    'image' => ['required', 'string'],
                    'view' => ['nullable', 'integer'],
                ]);

                if ($validator->fails()) {
                    $message = implode('', $validator->errors()->all());
                    $listError[] = 'Line ' . $key + 1 . ': ' . $message;
                } else {
                    try {
                        $course = Course::create($tmp);
                        ManageCourse::create([
                            'user_id' => auth()->user()->id,
                            'course_id' => $course->id,
                            'type' => 0,
                        ]);
                    } catch (\Exception $e) {
                        $listError[] = 'Line ' . $key + 1 . ': ' . $e->getMessage();
                    }
                }
            }

            return $this->successResponse($listError, trans('Import data successfully'));
        } catch (\Exception $e) {
            return $this->errorResponse(trans("Error Unknown"));
        }
    }
}
