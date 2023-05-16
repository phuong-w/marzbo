<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;

class SocialMedia extends Model
{
    use HasFactory;

    protected $table = 'social_medias';

    protected $fillable = [
        'name',
        'status'
    ];

    const FACEBOOK      = 1;
    const INSTAGRAM     = 2;
    const TIKTOK        = 3;
    const YOUTUBE       = 4;
    const TWITTER       = 5;

    public static $socialMedias = [
        self::FACEBOOK      => 'Facebook',
        self::INSTAGRAM     => 'Instagram',
        self::TIKTOK        => 'Tiktok',
        self::YOUTUBE       => 'Youtube',
        self::TWITTER       => 'Twitter'
    ];

    /**
     * Get the social media categories for the social media.
     */
    public function socialMediaCategories(): HasMany
    {
        return $this->hasMany(SocialMediaCategory::class);
    }

    /**
     * The categories that belong to the social media.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->using(SocialMediaCategory::class);
    }

    /**
     * The social media credential of the social media belong to the current user
     */
    public function socialMediaCredential(): HasOne
    {
        return $this->hasOne(SocialMediaCredential::class)->where('user_id', auth()->id());
    }

    /**
     * Scope a query to only include active social medias.
     *
     * @param $query
     * @return Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', CONST_ENABLE);
    }
}
