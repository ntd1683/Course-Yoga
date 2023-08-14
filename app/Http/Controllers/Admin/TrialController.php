<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UpdateContactRequest;
use App\Models\Contact;
use App\Models\PhoneTrial;

class TrialController extends Controller
{
    public function index()
    {
        return view('trial.index');
    }

    public function edit(PhoneTrial $trial)
    {
        return view('trial.edit', compact('trial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, PhoneTrial $trial)
    {
        try {
            $trial->update($request->validated());

            return redirect()->route('admin.trial.index')->with('success', trans('Update Successfully'));
        } catch (\Exception $e) {
            return redirect()->route('admin.trial.index')->withErrors(trans('Update Failure'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhoneTrial $trial)
    {
        $trial->delete();

        return redirect()
            ->route('admin.trial.index')
            ->with('success', trans('Delete Successfully'));
    }
}
