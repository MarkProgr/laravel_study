<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'height',
        'date_of_birth'
    ];

    protected $casts = [
        'date_of_birth' => 'date:d/m/Y'
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_actors');
    }
}
