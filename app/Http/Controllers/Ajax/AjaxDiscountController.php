<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Trait\ResponseTrait;
use App\Models\Discount;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Yajra\DataTables\DataTables;

class AjaxDiscountController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $discounts = Discount::query();
        return DataTables::of($discounts)
            ->editColumn('user_id', function ($object) {
                return $object->user->name;
            })
            ->editColumn('expired_at', function ($object) {
                return Carbon::parse($object->expired_at)->format('d-m-Y');
            })
            ->addColumn('author', function ($object) {
                return $object->author->name ?? '';
            })
            ->addColumn('destroy', function ($object) {
                return route('admin.ajax.discount.destroy', $object);
            })
            ->addColumn('edit', function ($object) {
                return route('admin.discount.edit', $object);
            })
            ->make(true);
    }

    public function getDiscount(Request $request): JsonResponse
    {
        $code = $request->get('code');

        if(! $code) {
            return $this->errorResponse(trans("Missing Param"));
        }

        try {
            $discount = Discount::query()
                ->where('code', $code)
                ->where('expired_at', '>=', now())
                ->where('active', 1)
                ->first();

            if(! $discount) {
                return $this->errorResponse(trans("Invalid discount code"));
            }

            return $this->successResponse($discount->percent, trans("Get Discount Successfully"));
        } catch (\Exception $e) {
            return $this->errorResponse(trans("Invalid discount code"));
        }
    }

    public function name(Request $request): array|Collection
    {
        $order = Discount::query();
        return $order->where('name', 'like', '%' . $request->get('q') . '%')->get();
    }

    public function code(Request $request): array|Collection
    {
        $order = Discount::query();
        return $order->where('code', 'like', '%' . $request->get('q') . '%')->get();
    }

    public function user(Request $request): array|Collection
    {
        $q = $request->get('q');
        $arrUserId = Discount::query()->pluck('user_id');
        $user = User::query()
            ->whereIn('id', $arrUserId)
            ->where('name', 'like', '%' . $q . '%')
            ->get();
        return $user;
    }

    public function destroy(Discount $discount): JsonResponse
    {
        $discount->delete();

        return $this->successResponse('', trans('Delete Contact Successfully'));
    }
}
