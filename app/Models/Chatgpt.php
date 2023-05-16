<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatgpt extends Model
{
    use HasFactory;

    const GPT_MODEL = 'gpt-3.5-turbo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'user_id',
        'context'
    ];

    protected $guarded = [];

    protected $casts = [
        'context' => 'array'
    ];
}
