<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';

    protected $fillable = [
        'title',
        'original_title',
        'poster_url',
        'release_year',
        'description',
        'original_language',
        'tmdb_id',
    ];

}
