<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserList extends Model
{
    protected $table = 'user_lists';

    protected $fillable = [
        'name',
        'img',
        'isPublic',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function movies()
{
    return $this->belongsToMany(Movie::class, 'user_list_movies')->withTimestamps();
}
}
