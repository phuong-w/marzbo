<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'status'
    ];

    /**
     * Get the social media categories for the category.
     */
    public function socialMediaCategories(): HasMany
    {
        return $this->hasMany(SocialMediaCategory::class);
    }

    /**
     * The social medias that belong to the category.
     */
    public function socialMedias(): BelongsToMany
    {
        return $this->belongsToMany(SocialMedia::class)->using(SocialMediaCategory::class);
    }
}
