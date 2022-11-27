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

    public function addOrRemoveToFavoriteMovie(Request $request)
    {
        $user = $request->user();
        $movieId = $request->movie_id;

        $user
            ->getFavoriteMovies()
            ->toggle([$movieId]);

        $favorites = $user->getFavoriteMovies()->get();
        return response()->json([
            'message' => 'success',
            'favorites' => $favorites
        ]);
    }

    public function getFavoriteMovies(Request $request)
    {
        $user = $request->user();

        $favorites = $user->getFavoriteMovies()->get();

        return response()->json([
            'message' => 'success',
            'favorites' => $favorites
        ]);
    }
}
