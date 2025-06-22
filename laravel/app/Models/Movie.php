<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';

    protected $fillable = [
        'title',
        'poster_url',
        'release_year',
        'runtime',
        'overview',
        'tmdb_id',
    ];
}
