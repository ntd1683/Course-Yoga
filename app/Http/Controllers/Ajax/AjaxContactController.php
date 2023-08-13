<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Trait\ResponseTrait;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class AjaxContactController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $contact = Contact::query();
        return DataTables::of($contact)
            ->editColumn('title', function ($object) {
                return [
                    'title' => $object->title,
                    'value' => Str::limit($object->title, 20),
                ];
            })
            ->addColumn('destroy', function ($object) {
                return route('admin.ajax.contact.destroy', $object);
            })
            ->addColumn('edit', function ($object) {
                return route('admin.contact.edit', $object);
            })
            ->make(true);
    }

    public function title(Request $request)
    {
        return Contact::query()->where('title', 'like', '%' . $request->get('q') . '%')->get();
    }

    public function name(Request $request)
    {
        return Contact::query()->where('name', 'like', '%' . $request->get('q') . '%')->get();
    }

    public function destroy(Contact $contact): JsonResponse
    {
        if (auth()->user()->level !== 3) {
            return $this->errorResponse(trans('You do not have permission to delete this course !'));
        }

        $contact->delete();

        return $this->successResponse('', trans('Delete Contact Successfully'));
    }
}
