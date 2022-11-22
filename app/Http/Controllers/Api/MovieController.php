<?php

namespace App\Http\Controllers\Api;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function getFeaturedMovies()
    {
        return response()->json([
           'message' => 'success',
           'movies' => Movie::whereNotNull('banner_url')->take(12)->get()
        ]);
    }

    public function getPopularMovies()
    {
        return response()->json([
            'message' => 'success',
            'movies' => Movie::orderBy('rating', 'desc')->take(36)->get()
        ]);
    }

    public function getMovieInfo(Request $request)
    {
        $movie_id = $request->movie_id;
        return response()->json([
            'message' => 'success',
            'movie' => Movie::find($movie_id)
        ]);
    }
}
