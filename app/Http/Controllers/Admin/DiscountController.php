<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Carbon\Carbon;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('discount.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $birthdate = Carbon::parse($request->birthdate)->format('Y-m-d');
        $password = Hash::make('12345678');
        $user = User::create([
            ...$request->validated(),
            'password' => $password,
            'birthdate' => $birthdate,
        ]);

        Mail::send('email.create-user', compact('user'), function ($email) use ($user) {
            $email->subject(option('site_name') . trans(' - invitation to join'));
            $email->to($user->email, $user->name);
        });

        return redirect()->route('admin.user.index')->with('success', trans('Add User Successfully'));
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
    public function edit(User $user)
    {
        $user->birthdate = Carbon::parse($user->birthdate)->format('Y-m-d');
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        $user->update($data);

        return redirect()->route('admin.user.index')->with('success', trans('Edit User Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (auth()->user()->level !== 3 || auth()->user()->id === $user->id) {
            return $this->errorResponse(trans('You do not have permission to delete this !'));
        }

        $user->delete();

        return redirect()
            ->route('admin.user.index')
            ->with('success', trans('Delete Successfully'));
    }
}
