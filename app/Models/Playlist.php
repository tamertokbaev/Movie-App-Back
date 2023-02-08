<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function author()
    {
        return $this->hasOne(User::class);
    }

    public function getRelatedMovies()
    {
        return $this->belongsToMany(Movie::class, 'playlist_movies', 'playlist_id', 'movie_id');
    }
}
