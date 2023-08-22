<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDiscountRequest;
use App\Models\Discount;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('discount.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('discount.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiscountRequest $request): RedirectResponse
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
    public function edit(Discount $discount): View
    {
        return view('discount.edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDiscountRequest $request, Discount $discount): RedirectResponse
    {
        $data = $request->validated();

        $discount->update($data);

        return redirect()->route('admin.discount.index')->with('success', trans('Edit Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount): RedirectResponse
    {
        $discount->delete();

        return redirect()
            ->route('admin.discount.index')
            ->with('success', trans('Delete Successfully'));
    }
}
