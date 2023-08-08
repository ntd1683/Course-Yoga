<?php

namespace App\Models;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Lesson extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'course_id',
        'link_embedded',
        'description',
        'user_id',
        'view',
        'image',
        'published',
        'accepted',
        'publish_at',
        'accepted_at',
    ];

    public function publish(): void
    {
        $this->publish_at = now();

        $this->published = true;

        $this->save();
    }

    public function accept(): void
    {
        $this->accepted = true;

        $this->accepted_at = now();

        if (!$this->publish_at || Carbon::parse($this->publish_at)->isPast()) {
            $this->publish();
        }

        $this->save();
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('published', true);
    }

    public function scopeAccepted(Builder $query): void
    {
        $query->where('accepted', true);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
