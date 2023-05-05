<?php

namespace App\Models;

use App\Traits\CredentialTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

class SocialMediaCredential extends Model
{
    use HasFactory, CredentialTrait;

    protected $table = 'social_media_credentials';

    protected $fillable = [
        'user_id',
        'social_media_id',
        'credentials',
        'status'
    ];

    /**
     * Get the "facebook access_token" attribute from credentials.
     *
     * @param $value
     * @return mixed
     */
    public function getFacebookAccessTokenAttribute($value)
    {
        return $this->socialMedia(FACEBOOK) ? $this->credentials->token : '';
    }

    /**
     * Get the user that owns the social media credential.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the social media that owns the social media credential.
     */
    public function socialMedia(): BelongsTo
    {
        return $this->belongsTo(SocialMedia::class);
    }

    /**
     * Get the facebook groups for the social media credential.
     */
    public function facebookGroups(): HasMany
    {
        return $this->hasMany(FacebookGroup::class);
    }

    /**
     * Scope a query to only include social media id.
     *
     * @param $query
     * @return Builder
     */
    public function scopeSocialMedia($query, $socialMediaId)
    {
        return $query->where('social_media_id', $socialMediaId);
    }
}
