<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'birthdate',
        'gender',
        'level',
        'phone',
        'address',
        'avatar',
        'email_verified',
    ];

    public $timestamps = true;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected function avatarUrl(): Attribute
    {
        return Attribute::get(function () {
            if ($this->avatar === null) {
                $name = explode(' ', $this->name);
                return 'https://ui-avatars.com/api/?background=random&name=' . urlencode(end($name));
            }

            return Storage::url($this->avatar);
        })->shouldCache();
    }

    public function manageLecturers(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'manage_courses');
    }

    public function manageSubscribe(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'subcription_courses');
    }

    protected function revenue(): Attribute
    {
        return Attribute::get(function () {
            $total = 0;

            foreach ($this->orders as $order) {
                $total += $order->total;
            }

            return $total;
        })->shouldCache();
    }

    protected function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
