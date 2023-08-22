<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonRequest;
use App\Models\Lesson;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('lesson.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('lesson.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLessonRequest $request): RedirectResponse
    {
        try {
            $linkEmbedded = $request->get('link_embedded');
            if(! str_contains($linkEmbedded, "watch")) {
                $linkEmbedded = explode("/", $linkEmbedded)[3];
                $linkEmbedded = "https://www.youtube.com/watch?v=" . $linkEmbedded;
            }
            $filePath = null ;
            if($request->hasFile('image')) {
                $file = $request->file('image');
                $nameFile = 'lesson_' . Str::random(5) . '.' . $file->extension();
                $filePath = $file->storeAs('images/lesson', $nameFile, 'public');
            }

            $lesson = Lesson::create([
                ...$request->validated(),
                'image' => $filePath,
                'user_id' => auth()->user()->id,
                'link_embedded' => $linkEmbedded,
            ]);

            if ($request->get('published')) {
                $lesson->publish();
            } else {
                $lesson->published = 0;
                $lesson->save();
            }

            if ($request->get('accepted') && auth()->user()->level === 2) {
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
    public function edit(Lesson $lesson): View
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
    public function update(StoreLessonRequest $request, Lesson $lesson): RedirectResponse
    {
        try {
            $data = $request->validated();

            $linkEmbedded = $request->get('link_embedded');
            if(! str_contains($linkEmbedded, "watch")) {
                $linkEmbedded = explode("/", $linkEmbedded)[3];
                $linkEmbedded = "https://www.youtube.com/watch?v=" . $linkEmbedded;
                $data['link_embedded'] = $linkEmbedded;
            }

            $image = $lesson->image;
            if ($request->hasFile('image')) {
                Storage::disk('public')->delete($image);

                $file = $request->file('image');
                $nameFile = 'lesson_'.Str::random(5).'.'.$file->extension();
                $filePath = $file->storeAs('images/lesson', $nameFile, 'public');
                $data['image'] = $filePath;
            }

            $lesson->update($data);

            if ($request->get('published')) {
                $lesson->publish();
            } else {
                $lesson->published = 0;
                $lesson->save();
            }

            if ($request->get('accepted') && auth()->user()->level === 2) {
                $lesson->accept();
            }

            return redirect()->route('admin.lesson.index')->with('success', trans('Update Lesson Successfully'));
        } catch (\Exception $e) {
            return redirect()->route('admin.lesson.index')->withErrors(trans('Update Lesson Failure'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson): RedirectResponse
    {
        $lesson->delete();

        return redirect()
            ->route('admin.lesson.index')
            ->with('success', trans('Delete Lesson Successfully'));
    }
}
