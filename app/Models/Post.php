<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const POST_IMAGES_COLLECTION = 'post_images';
    const POST_VIDEOS_COLLECTION = 'post_videos';

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
