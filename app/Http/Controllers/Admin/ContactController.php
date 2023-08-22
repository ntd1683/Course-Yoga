<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('contact.admin.index');
    }

    public function edit(Contact $contact): View
    {
        return view('contact.admin.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact): RedirectResponse
    {
        try {
            $contact->update($request->validated());

            return redirect()->route('admin.contact.index')->with('success', trans('Update Contact Successfully'));
        } catch (\Exception $e) {
            return redirect()->route('admin.contact.index')->withErrors(trans('Update Contact Failure'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return redirect()
            ->route('admin.contact.index')
            ->with('success', trans('Delete Contact Successfully'));
    }
}
