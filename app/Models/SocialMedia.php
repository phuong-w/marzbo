<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SocialMedia extends Model
{
    use HasFactory;

    protected $table = 'social_medias';

    protected $fillable = [
        'name',
        'status'
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
}
