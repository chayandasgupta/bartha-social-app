<?php

namespace App\Models;

use App\Constants\MediaCollectionName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Str;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'uuid',
        'description',
        'view_count'
    ];


    public function getPostImage()
    {
        return $this->getFirstMediaUrl(MediaCollectionName::POST_IMAGE);
    }

    public function scopeWithUserAndComments($query)
    {
        return $query->select('id', 'description', 'uuid', 'user_id')
            ->withCount('comments')
            ->with(['user:id,name,user_name,uuid,image', 'user.media']);
    }

    /**
     * Get the comments for the blog post.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(MediaCollectionName::POST_IMAGE)
            ->singleFile()
            ->useDisk('media');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
}
