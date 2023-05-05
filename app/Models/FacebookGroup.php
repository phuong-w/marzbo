<?php

namespace App\Models;

use App\Traits\CredentialTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacebookGroup extends Model
{
    use HasFactory, CredentialTrait;

    protected $table = 'facebook_groups';

    protected $fillable = [
        'social_media_credential_id',
        'user_id',
        'group_id',
        'group_name',
        'credentials'
    ];
}
