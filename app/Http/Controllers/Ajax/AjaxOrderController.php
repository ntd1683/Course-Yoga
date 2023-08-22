<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AjaxOrderController extends Controller
{
    public function index()
    {
        $orders = Order::query();
        return DataTables::of($orders)
            ->editColumn('user_id', function ($object) {
                return $object->user->name;
            })
            ->editColumn('course_id', function ($object) {
                return $object->course->title;
            })
            ->editColumn('created_at', function ($object) {
                return Carbon::parse($object->created_at)->format('d-m-Y');
            })
            ->addColumn('edit', function ($object) {
                return route('admin.order.edit', $object);
            })
            ->make(true);
    }

    public function code(Request $request): array|Collection
    {
        $order = Order::query();
        return $order->where('code', 'like', '%' . $request->get('q') . '%')->get();
    }

    public function course(Request $request): array|Collection
    {
        $q = $request->get('q');
        $arrOrderId = Order::query()->pluck('course_id');
        $order = Course::query()
            ->whereIn('id', $arrOrderId)
            ->where('title', 'like', '%' . $q . '%')
            ->get();
        return $order;
    }

    public function name(Request $request): array|Collection
    {
        $q = $request->get('q');
        $arrUserId = Order::query()->pluck('user_id');
        $user = User::query()
            ->whereIn('id', $arrUserId)
            ->where('name', 'like', '%' . $q . '%')
            ->get();
        return $user;
    }

    public function referralCode(Request $request): array|Collection
    {
        $order = Order::query();
        return $order->where('referral_code', 'like', '%' . $request->get('q') . '%')->get();
    }
}
