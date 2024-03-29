<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    use HasFactory;

    const STT_PENDING    = 1;
    const STT_SUCCESS    = 2;
    const STT_ERROR      = 3;

    protected $table = 'schedules';
    protected $fillable = [
        'user_id',
        'post_id',
        'social_media_id',
        'publish_date',
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'publish_date' => 'datetime',
    ];

    public static $scheduleStatuses = [
        self::STT_PENDING => [
            'name' => 'Pending',
            'badge_outline' => 'badge outline-badge-warning'
        ],
        self::STT_SUCCESS => [
            'name' => 'Success',
            'badge_outline' => 'badge outline-badge-primary'
        ],
        self::STT_ERROR => [
            'name' => 'Error',
            'badge_outline' => 'badge outline-badge-danger'
        ]
    ];

    /**
     * Get the user that owns the schedule.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the post that owns the schedule.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the social media credential that owns the schedule.
     */
    public function socialMedia(): BelongsTo
    {
        return $this->belongsTo(SocialMedia::class);
    }
}
