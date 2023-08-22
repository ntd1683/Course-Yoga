<?php

namespace App\Http\Controllers\Ajax;

use App\Enums\UserLevelEnum;
use App\Http\Controllers\Controller;
use App\Http\Trait\ResponseTrait;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AjaxUserController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $user = User::query();
        return DataTables::of($user)
            ->editColumn('birthdate', function ($object) {
                return Carbon::parse($object->birthdate)->format('d-m-Y');
            })
            ->editColumn('level', function ($object) {
                return UserLevelEnum::getKeyByValue($object->level);
            })
            ->editColumn('revenue', function ($object) {
                return price_format($object->revenue) . ' VNĐ';
            })
            ->addColumn('destroy', function ($object) {
                return route('admin.ajax.user.destroy', $object);
            })
            ->addColumn('edit', function ($object) {
                return route('admin.user.edit', $object);
            })
            ->make(true);
    }
    public function lecturers(): array|Collection
    {
        return User::select('id', 'email')
            ->where('level', 2)
            ->get();
    }

    public function name(Request $request): array|Collection
    {
        return User::query()->where('name', 'like', '%' . $request->get('q') . '%')->get();
    }

    public function destroy(User $user): JsonResponse
    {
        if (auth()->user()->level !== 3 || auth()->user()->id === $user->id) {
            return $this->errorResponse(trans('You do not have permission to delete this !'));
        }

        $user->delete();

        return $this->successResponse('', trans('Delete Successfully'));
    }
}
