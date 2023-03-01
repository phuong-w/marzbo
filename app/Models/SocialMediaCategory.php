<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SocialMediaCategory extends Pivot
{
    use HasFactory;

    protected $table = 'social_media_category';

    protected $fillable = [
        'social_media_id',
        'category_id',
        'status'
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Get the social media that owns the social media category.
     */
    public function socialMedia(): BelongsTo
    {
        return $this->belongsTo(SocialMedia::class);
    }

    /**
     * Get the category that owns the social media category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
