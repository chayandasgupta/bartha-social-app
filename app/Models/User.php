<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Constants\MediaCollectionName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, HasUuids, Notifiable;
    use InteractsWithMedia;

    const DEFAULT_IMAGE_PATH = '/empty.jpg';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_name',
        'email',
        'password',
        'bio',
        'image'
    ];

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

    public function isAuthor(): bool
    {
        return auth()->id() === $this->id;
    }

    public function firstName(): string
    {
        return str()->of($this->name)->before(' ')->title();
    }

    public function fullName(): string
    {
        return str()->of($this->name)->title();
    }

    public function getProfileImage()
    {
        return $this->getFirstMediaUrl(MediaCollectionName::PROFILE_IMAGE);
    }
    
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection(MediaCollectionName::PROFILE_IMAGE)
            ->singleFile()
            ->useDisk('avatar')
            ->useFallbackUrl(self::DEFAULT_IMAGE_PATH);
    }
}