<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonRequest;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\ManageCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('lesson.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lesson.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLessonRequest $request)
    {
        if(! $request->hasFile('image')) {
            return redirect()->back()->withErrors(trans('Image Required'));
        }
        try {
            $file = $request->file('image');
            $nameFile = 'lesson_' . Str::random(5) . '.' . $file->extension();
            $filePath = $file->storeAs('images/lesson', $nameFile, 'public');

            $lesson = Lesson::create([
                ...$request->validated(),
                'image' => $filePath,
                'user_id' => auth()->user()->id,
            ]);

            if ($request->get('published')) {
                $lesson->publish();
            } else {
                $lesson->published = 0;
                $lesson->save();
            }

            if ($request->get('accepted') && auth()->user()->level === 3) {
                $lesson->accept();
            }

            return redirect()->route('admin.lesson.index')->with('success', trans('Add Lesson Successfully'));
        } catch (\Exception $e) {
            return redirect()->route('admin.lesson.index')->withErrors(trans('Add Lesson Failure'));
        }
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
    public function edit(Lesson $lesson)
    {
        $course = $lesson
            ->course()
            ->select('title', 'id')
            ->first()
            ->toJson();

        return view('lesson.edit', compact('lesson', 'course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreLessonRequest $request, Lesson $lesson)
    {
        try {
            $data = $request->validated();

            $image = $lesson->image;
            if ($request->hasFile('image')) {
                Storage::disk('public')->delete($image);

                $file = $request->file('image');
                $nameFile = 'lesson_'.Str::random(5).'.'.$file->extension();
                $filePath = $file->storeAs('images/lesson', $nameFile, 'public');
                $data['image'] = $filePath;
            }

            $lesson->update($data);

            return redirect()->route('admin.course.index')->with('success', trans('Add Course Successfully'));
        } catch (\Exception $e) {
            return redirect()->route('admin.course.index')->withErrors(trans('Add Course Failure'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
