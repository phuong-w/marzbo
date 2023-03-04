<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialMediaCredential extends Model
{
    use HasFactory;

    protected $table = 'social_media_credentials';

    protected $fillable = [
        'user_id',
        'social_media_id',
        'credentials',
        'status'
    ];

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
}
