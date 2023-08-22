<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscribeTrialRequest;
use App\Http\Trait\ResponseTrait;
use App\Models\PhoneTrial;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AjaxTrialController extends Controller
{
    use ResponseTrait;

    public function subscribe(SubscribeTrialRequest $request): JsonResponse
    {
        try {
            PhoneTrial::create([
                ...$request->validated(),
            ]);

            return $this->successResponse([], trans("Successfully registered for a consultation"));
        } catch (\Exception $e) {
            return $this->errorResponse(trans("Error Unknown"));
        }
    }

    public function index()
    {
        $trial = PhoneTrial::query();
        return DataTables::of($trial)
            ->editColumn('created_at', function ($object) {
                return Carbon::parse($object->created_at)->format('H:i:s d-m-Y');
            })
            ->addColumn('destroy', function ($object) {
                return route('admin.ajax.trial.destroy', $object);
            })
            ->addColumn('edit', function ($object) {
                return route('admin.trial.edit', $object);
            })
            ->make(true);
    }

    public function phone(Request $request): array|Collection
    {
        return PhoneTrial::query()->where('phone', 'like', '%' . $request->get('q') . '%')->get();
    }

    public function destroy(PhoneTrial $trial): JsonResponse
    {
        if (auth()->user()->level !== 3) {
            return $this->errorResponse(trans('You do not have permission to delete this !'));
        }

        $trial->delete();

        return $this->successResponse('', trans('Delete Successfully'));
    }
}
