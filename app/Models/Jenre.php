<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenre extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_jenres');
    }
}
