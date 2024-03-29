<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        'context',
        'total_react',
        'total_view',
        'total_comment',
        'status'
    ];

    public $with = ['media'];

    public static $postStatuses = [
        self::STT_UNPUBLISHED => 'Un published',
        self::STT_PUBLISHED => 'Published'
    ];

    public function schedule()
    {
        return $this->hasOne(Schedule::class, 'post_id', 'id');
    }

    /**
     * Set the "context" attribute to JSON encoded value.
     *
     * @param $value
     * @return void
     */
    public function setContextAttribute($value)
    {
        $this->attributes['context'] = json_encode($value);
    }

    /**
     * Get the "context" attribute as a decoded JSON value.
     *
     * @param $value
     * @return mixed
     */
    public function getContextAttribute($value)
    {
        return json_decode($value);
    }

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
