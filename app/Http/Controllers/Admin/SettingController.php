<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function __construct(protected ProfileService $profileService)
    {
    }
    public function index(): View
    {
        return view('setting.admin.index');
    }

    public function store(StoreSettingRequest $request): RedirectResponse
    {
        optionSave('site_name', $request->get('site_name'));
        optionSave('site_description', $request->get('site_description'));
        optionSave('site_phone', $request->get('site_phone'));
        optionSave('site_email', $request->get('site_email'));
        optionSave('site_address', $request->get('site_address'));
        optionSave('site_language', $request->get('site_language'));

        if (option('site_logo')) {
            Storage::disk('public')->delete(option('site_logo'));
        }

        if ($request->hasFile('site_logo')) {
            $fileLogo = $request->file('site_logo');
            $nameFileLogo = 'logo_' . Str::random(5) . '.' . $fileLogo->extension();
            $filePathLogo = $fileLogo->storeAs('images', $nameFileLogo, 'public');

            optionSave('site_logo', $filePathLogo);
        }

        if (option('site_favicon')) {
            Storage::disk('public')->delete(option('site_favicon'));
        }

        if ($request->hasFile('site_favicon')) {
            $fileFavicon = $request->file('site_favicon');
            $nameFileFavicon = 'favicon_' . Str::random(5) . '.' . $fileFavicon->extension();
            $filePathFavicon = $fileFavicon->storeAs('images', $nameFileFavicon, 'public');

            optionSave('site_favicon', $filePathFavicon);
        }

        return redirect()->route('admin.index')->with('success', trans('Save Setting Successfully'));
    }

    public function profile(): View
    {
        return view('setting.admin.profile');
    }
    public function updateProfile(UpdateProfileRequest $request): RedirectResponse
    {
        if($this->profileService->update($request)) {
            return redirect()->back()->with('success', trans('Profile Updated Successfully'));
        }
        return redirect()->back()->with('error', trans('Error Unknown'));
    }
}
