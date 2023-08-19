<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Course;
use App\Models\Discount;
use App\Models\Order;
use App\Models\SubcriptionCourse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index(Course $course)
    {
        return view('order.user.index', compact('course'));
    }

    public function order(OrderRequest $request, Course $course)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();

            $order = Order::create([
                ...$data,
                'user_id' => auth()->user()->id,
                'course_id' => $course->id,
                'status' => 0,
                'total' => $course->price,
                'code' => 'BILL_'.Str::random(6),
            ]);

            SubcriptionCourse::create([
                'course_id' => $course->id,
                'user_id' => auth()->user()->id,
            ]);

            if ($request->get('discount')) {
                $discount = Discount::query()->where("code", $request->get("discount"))->first();
                $total = $course->price - $course->price*$discount->percent/100;

                $order->total = $total;
                $order->discount_id = $discount->id;
                $order->save();
            }

            DB::commit();


            if($request->type == 2) {
                return redirect()->route('checkout.momo', $order);
            } else {
                return redirect()->route('checkout.vnpay', $order);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('course.show', $course)->withErrors(trans('Error Unknown'));
        }
    }
}
