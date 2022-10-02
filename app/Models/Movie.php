<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'year_of_issue',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function jenres()
    {
        return $this->belongsToMany(Jenre::class, 'movie_jenres');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'movie_actors');
    }
}
