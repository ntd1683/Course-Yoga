<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageDetail extends Model
{
    use HasFactory;

    protected $table = "image_detail";

    public $timestamps = false;

    protected $fillable = [
        'object_id',
        'image_id',
        'user_id',
        'object_type',
        'object_name',
    ];
}
