<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'status',
        'type',
        'discount_id',
        'total',
        'referral_code',
        'code',
        'name',
        'phone',
        'email',
    ];
}
