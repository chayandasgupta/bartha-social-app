<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'uuid',
        'description',
        'view_count',
        'image',
    ];

    public function scopeWithUserAndComments($query)
    {
        return $query->select('id', 'description', 'uuid', 'user_id')
            ->withCount('comments')
            ->with(['user:id,name,user_name,uuid']);
    }

    /**
     * Get the comments for the blog post.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
