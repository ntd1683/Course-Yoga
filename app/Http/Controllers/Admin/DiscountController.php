<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDiscountRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Discount;
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
        return view('discount.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiscountRequest $request)
    {
        $expired_at = Carbon::parse($request->get('expired_at'))->format('Y-m-d');
        if( $expired_at < now()) {
            return redirect()->route('admin.discount.index')->withErrors('The expiry date must be before the current time');
        }

        Discount::create([
            ...$request->validated(),
            "user_id" => auth()->user()->id,
            "expired_at" => $expired_at,
        ]);
        return redirect()->route('admin.discount.index')->with('success', trans('Add Discount Successfully'));
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
    public function edit(Discount $discount)
    {
        return view('discount.edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDiscountRequest $request, Discount $discount)
    {
        $data = $request->validated();

        $discount->update($data);

        return redirect()->route('admin.discount.index')->with('success', trans('Edit Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();

        return redirect()
            ->route('admin.discount.index')
            ->with('success', trans('Delete Successfully'));
    }
}
