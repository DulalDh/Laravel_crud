<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'mediable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
