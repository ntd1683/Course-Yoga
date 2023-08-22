<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddGamailRequest;
use App\Http\Requests\UpdateSubscribeRequest;
use App\Models\SubcriptionCourse;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('subscribe.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('subscribe.add-gmail');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddGamailRequest $request): RedirectResponse
    {
        $course_id = $request->get('title');
        $emails = explode(",", $request->get('emails'));
        $users = [];
        foreach ($emails as $email) {
            $user_id = User::query()->where("email", $email)->first()->id;
            $subscribe = SubcriptionCourse::query()
                ->where("course_id", $course_id)
                ->where("user_id", $user_id)
                ->first();
            $subscribe->status = 1;
            $subscribe->save();
        }

        return redirect()->route("admin.subscribe.index")->with("success", trans("Update Successfully"));
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
    public function edit(SubcriptionCourse $subscription): View
    {
        $lessons = $subscription->course()->first()->lessons()->get();
        return view('subscribe.edit', compact('subscription', 'lessons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscribeRequest $request, SubcriptionCourse $subscription): RedirectResponse
    {
        try {
            $subscription->update($request->validated());

            return redirect()->route('admin.subscribe.index')->with('success', trans('Update Successfully'));
        } catch (\Exception $e) {
            return redirect()->route('admin.subscribe.index')->withErrors(trans('Update Failure'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubcriptionCourse $subscription): RedirectResponse
    {
        $subscription->delete();

        return redirect()
            ->route('admin.subscribe.index')
            ->with('success', trans('Delete Successfully'));
    }
}
