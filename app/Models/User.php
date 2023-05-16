<?php


namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OpenAI;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes, InteractsWithMedia;

    const AVATAR_PLACEHOLDER = 'https://ui-avatars.com/api/?background=random&name=';
    const AVATAR_COLLECTION = 'avatar';
    const AVATAR_RESIZE_NAME = 'avatar_resize';
    const CONVERSION_SIZE = [
        'width' => 200,
        'height' => 200
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'reset_password_at',
        'openai_api_key'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'reset_password_at' => 'datetime'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['avatar'];

    public $with = ['media'];

    /**
     * Get the chatGPT for the user.
     */
    public function chatGpts(): HasMany
    {
        return $this->hasMany(ChatGpt::class)->latest('updated_at');
    }

    /**
     * Get the social media for the user.
     */
    public function socialMedias(): belongsToMany
    {
        return $this->belongsToMany(SocialMedia::class, SocialMediaCredential::class);
    }

    /**
     * Get the social media credentials for the user.
     */
    public function socialMediaCredentials(): hasMany
    {
        return $this->hasMany(SocialMediaCredential::class);
    }

    /**
     * The social media credential is Facebook
     */
    public function facebookCredential(): hasOne
    {
        return $this->hasOne(SocialMediaCredential::class)->socialMedia(FACEBOOK);
    }

    /**
     * Get credential of Facebook
     */
    public function getFacebookCredential()
    {
        return $this->facebookCredential ? $this->facebookCredential->credentials : '';
    }

    /**
     * Get the "facebook access_token" attribute from credentials.
     */
    public function getFacebookAccessTokenAttribute()
    {
        return $this->facebookCredential ? $this->facebookCredential->credentials->token : '';
    }

    /**
     * Get api key of openai
     */
    public function getOpenaiApiKey()
    {
        return $this->openai_api_key ? OpenAI::client($this->openai_api_key) : null;
    }

    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getAvatarAttribute($value)
    {
        $avatar = $this->getFirstMediaUrl(self::AVATAR_COLLECTION);
        if ($avatar) {
            return $avatar;
        }

        return self::AVATAR_PLACEHOLDER . trim($this->name);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection(self::AVATAR_COLLECTION)
            ->singleFile();
    }

    /**
     * @param Media|null $media
     * @return void
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion(self::AVATAR_RESIZE_NAME)
            ->fit(Manipulations::FIT_FILL, self::CONVERSION_SIZE['width'], self::CONVERSION_SIZE['height'])
            ->background('fff')
            ->performOnCollections(self::AVATAR_COLLECTION)
            ->sharpen(10)
            ->nonQueued();
    }
}
