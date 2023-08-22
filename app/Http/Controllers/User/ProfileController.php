<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(protected ProfileService $profileService)
    {
    }
    public function profile(): View
    {
        return view('setting.user.profile');
    }

    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        if($this->profileService->update($request)) {
            return redirect()->back()->with('success', trans('Profile Updated Successfully'));
        }
        return redirect()->back()->with('error', trans('Error Unknown'));
    }
}
