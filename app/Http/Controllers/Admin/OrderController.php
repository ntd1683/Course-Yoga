<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index()
    {
        return view('order.admin.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('order.admin.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        try {
            $data = $request->validated();
            $order->update($data);

            return redirect()->route('admin.order.index')->with('success', trans('Add Successfully'));
        } catch (\Exception $e) {
            return redirect()->route('admin.order.index')->withErrors(trans('Add Failure'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()
            ->route('admin.order.index')
            ->with('success', trans('Delete Successfully'));
    }
}
