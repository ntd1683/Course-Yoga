<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'link_embedded',
        'type',
        'price',
        'view',
        'image',
    ];

    public function manageLecturers(): BelongsToMany
    {
        return $this
            ->belongsToMany(User::class, 'manage_courses')
            ->where('users.level', 2);
    }

    public function manageSubscriber(): BelongsToMany
    {
        return $this
            ->belongsToMany(User::class, 'subcription_courses');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    protected function author(): Attribute
    {
        return Attribute::get(function () {
            return User::query()
                ->whereHas("manageLecturers",
                    fn($query) => $query
                        ->where('course_id', $this->id)
                        ->where('manage_courses.type', 1))
                ->first();
        })->shouldCache();
    }
}
