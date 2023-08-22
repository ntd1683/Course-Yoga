<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Trait\ResponseTrait;
use App\Models\Course;
use App\Models\ManageCourse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CourseController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('course.admin.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('course.admin.create');
    }

    public function store(StoreCourseRequest $request): RedirectResponse
    {
        if(! $request->hasFile('image')) {
            return redirect()->back()->withErrors(trans('Image Required'));
        }
        try {
            $file = $request->file('image');
            $nameFile = 'course_' . Str::random(5) . '.' . $file->extension();
            $filePath = $file->storeAs('images/course', $nameFile, 'public');

            $course = Course::create([
                ...$request->validated(),
                'image' => $filePath,
                'price' => $request->get('price') ? $request->get('price') * 1000 : null,
            ]);

            ManageCourse::create([
                'course_id' => $course->id,
                'user_id' => auth()->user()->id,
                'type' => '1',
            ]);

            return redirect()->route('admin.course.index')->with('success', trans('Add Course Successfully'));
        } catch (\Exception $e) {
            return redirect()->route('admin.course.index')->withErrors(trans('Add Course Failure'));
        }
    }

    public function import(): View
    {
        return view('course.admin.import');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course): View
    {
        $lecturers = $course
            ->manageLecturers()
            ->select('user_id', 'email')
            ->get()
            ->toJson();

        return view('course.admin.edit', compact('course', 'lecturers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCourseRequest $request, Course $course): RedirectResponse
    {
        try {
            $data = $request->validated();

            $image = $course->image;
            if ($request->hasFile('image')) {
                Storage::disk('public')->delete($image);

                $file = $request->file('image');
                $nameFile = 'course_'.Str::random(5).'.'.$file->extension();
                $filePath = $file->storeAs('images/course', $nameFile, 'public');
                $data['image'] = $filePath;
            }

            $data['price'] = $request->get('price') ? $request->get('price') * 1000 : null;

            $course->update($data);

            if($users = $request->get('users')) {
                ManageCourse::query()->where('course_id', $course->id)->delete();
                foreach ($users as $id) {
                    ManageCourse::create([
                        'course_id' => $course->id,
                        'user_id' => $id,
                        'type' => '0',
                    ]);
                }
            }

            return redirect()->route('admin.course.index')->with('success', trans('Add Course Successfully'));
        } catch (\Exception $e) {
            return redirect()->route('admin.course.index')->withErrors(trans('Add Course Failure'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course): RedirectResponse
    {
        ManageCourse::query()->where('course_id', $course->id)->first()->delete;

        $course->delete();

        return redirect()
            ->route('admin.course.index')
            ->with('success', trans('Delete Course Successfully'));
    }
}
