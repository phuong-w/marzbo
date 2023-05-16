<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const POST_IMAGES_COLLECTION = 'post_images';
    const POST_VIDEOS_COLLECTION = 'post_videos';

    const STT_UNPUBLISHED    = 1;
    const STT_PUBLISHED      = 2;

    protected $table = 'posts';

    protected $fillable = [
        'group_id',
        'user_id',
        'category_id',
        'content',
        'social_media_id',
        'status'
    ];

    public $with = ['media'];

    public function scopePublished($query)
    {
        return $query->where('status', self::STT_PUBLISHED);
    }

    /**
     * Get list posts on social.
     */
    public function socialPosts(): HasMany
    {
        return $this->hasMany(Post::class, 'group_id', 'id');
    }

    /**
     * Get the latest post.
     */
    public function latestPost()
    {
        return $this->orderBy('created_at', 'desc')->first();
    }

    /**
     * Get the user that owns the post.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the post.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
