<?php

namespace App\Services;

use App\Models\Image;
use App\Models\ImageDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class ImageService
{
    public function create($file, $object_id, $object_type, String $object_name): bool
    {
        try {
            DB::beginTransaction();

            $nameFile = 'favicon_' . Str::random(5) . '.' . $file->extension();
            $filePath = $file->storeAs('images/course', $nameFile, 'public');

            $image = Image::create([
                'image_url' => $filePath,
                'type' => $file->extension(),
            ]);

            ImageDetail::create([
                'object_id' => $object_id,
                'image_id' => $image->id,
                'user_id' => auth()->user()->id,
                'object_type' => $object_type,
                'object_name' => $object_name,
            ]);

            DB::commit();

            return true;
        } catch (Throwable $throwable) {
            DB::rollBack();

            return false;
        }
    }
}
