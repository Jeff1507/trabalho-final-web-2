<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserListMovie extends Model
{
    protected $table = 'user_list_movies';

    protected $fillable = [
        'user_list_id',
        'movie_id'
    ];

    public function userList() {
        return $this->belongsTo(UserList::class);
    }

    public function movie() {
        return $this->belongsTo(Movie::class);
    }
}
