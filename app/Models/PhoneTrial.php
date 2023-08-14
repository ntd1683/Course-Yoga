<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneTrial extends Model
{
    use HasFactory;

    protected $table = "phones_trial";

    protected $fillable = [
        'phone',
        'type',
    ];
}
