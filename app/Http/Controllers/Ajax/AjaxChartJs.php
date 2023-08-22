<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Trait\ResponseTrait;
use App\Models\Order;
use Illuminate\Http\Request;

class AjaxChartJs extends Controller
{
    use ResponseTrait;
    public function revenue(Request $request)
    {
        $filter = $request->get('filter') ?: 0;
        $revenues = Order::query()
            ->selectRaw("SUM(total) as price")
            ->when($filter == 0, function ($q) {
                return $q
                    ->selectRaw("DATE_FORMAT(created_at,'%d-%m-%Y') as time")
                    ->where('created_at', '>', now()->subDays(30)->endOfDay())
                    ->orderByRaw('STR_TO_DATE(time, "%d-%m-%Y") ASC');
            })
            ->when($filter == 1, function ($q) {
                return $q
                    ->selectRaw("DATE_FORMAT(created_at,'%m-%Y') as time")
                    ->where('created_at', '>', now()->subMonths(12)->endOfMonth())
                    ->orderByRaw('STR_TO_DATE(time, "%m-%Y") ASC');
            })
            ->when($filter == 2, function ($q) {
                return $q
                    ->selectRaw("DATE_FORMAT(created_at,'%Y') as time")
                    ->orderByRaw('STR_TO_DATE(time, "%Y") ASC');
            })
            ->groupBy('time')
            ->where('status', 1)
            ->get();

        $result = [];
        foreach ($revenues as $each) {
            $result['labels'][] = $each->time;
            $result['data'][] = $each->price;
        }

        return $result;
    }
}
