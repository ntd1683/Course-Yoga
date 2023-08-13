<?php

namespace App\Services;

use App\Http\Requests\UpdateProfileRequest;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Throwable;

class ProfileService
{
    public function update(UpdateProfileRequest $request): bool
    {
        try {
            $data = $request->validated();
            $user = auth()->user();

            if ($request->filled('password')) {
                $data['password'] = Hash::make($data['password']);
            } else {
                Arr::forget($data, 'password');
            }

            if ($request->filled('birthdate')) {
                $data['birthdate'] = Carbon::createFromFormat('d/m/Y', $request->get('birthdate'))->format('Y-m-d');
            }
            $user->update($data);
            return true;
        } catch (Throwable $throwable) {
            return false;
        }
    }
}
