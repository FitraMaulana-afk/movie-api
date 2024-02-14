<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'movie_category_id',
        'title',
        'synopics',
        'image',
        'image_banner',
        'director',
        'duration',
        'usia',
        'realese_date'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(MovieCategory::class, 'movie_category_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}