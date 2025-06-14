<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'content',
        'isRemoved',
        'review_id'
    ];

    public function review() {
        return $this->belongsTo(Review::class);
    }
}
