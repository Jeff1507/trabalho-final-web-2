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
}
