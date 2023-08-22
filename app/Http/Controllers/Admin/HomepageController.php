<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\ManageCourse;
use App\Models\Order;
use App\Models\SubcriptionCourse;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    public function __invoke()
    {
        $statistical = [];
        $statistical['count_users'] = User::query()
            ->whereBetween('created_at', [new \DateTime('first day of this month'), new \DateTime('last day of this month')])
            ->count();

        $arrCourseId = SubcriptionCourse::query()->pluck('course_id');
        $courses = Course::query()
            ->whereIn('id', $arrCourseId)
            ->whereBetween('created_at', [new \DateTime('first day of this month'), new \DateTime('last day of this month')])
            ->count();
        $statistical['count_courses'] = $courses;

        $arrUserId = SubcriptionCourse::query()->pluck('user_id');
        $users = User::query()
            ->whereIn('id', $arrUserId)
            ->whereBetween('created_at', [new \DateTime('first day of this month'), new \DateTime('last day of this month')])
            ->count();

        $statistical['count_subscriber'] = $users;
        $statistical['payment'] = price_format(Order::query()->where('status', 1)->sum('total'));

        $tableUser = User::query()
            ->rightJoin('orders', 'users.id', 'orders.user_id')
            ->select('users.id', 'users.name', DB::raw('SUM(orders.total) AS total'))
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        $tableCourse = Course::query()
            ->rightJoin('orders', 'courses.id', 'orders.course_id')
            ->select('courses.id', 'courses.title', DB::raw('count(orders.id) AS count'))
            ->groupBy('courses.id', 'courses.title')
            ->orderByDesc('count')
            ->take(5)
            ->get();

        return view('homepage.admin.index', compact('statistical', 'tableUser', 'tableCourse'));
    }
}
