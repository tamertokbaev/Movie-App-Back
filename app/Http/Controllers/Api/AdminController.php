<?php

namespace App\Http\Controllers\Api;

use App\Models\Movie;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function createMovie(Request $request)
    {
        $user = $request->user();
        if (isset($user)) {
            $movie = Movie::create([
                'title' => $request->title,
                'description' => $request->description,
                'image_url' => $request->image_url,
                'banner_url' => $request->banner_url,
                'imdb_url' => $request->imdb_url,
                'release_date' => $request->release_date,
            ]);

            return response()->json([
                'message' => 'success',
                'movie' => $movie
            ]);
        }
        return response()->json([
            'message' => 'error',
        ]);
    }

    public function getListOfMovies(Request $request)
    {
        $rows = $request->rows;
        $offset = $request->page * $rows;

        $result = Movie::orderBy('updated_at', 'desc');

        $count = $result->count();
        $items = $result
            ->take($rows)
//            ->skip($offset)
            ->get();

        return [
            'message' => 'success',
            'items' => $items,
            'total' => $count
        ];
    }

    public function getMovie(Request $request)
    {
        $movieId = $request->movie_id;
        return response()->json([
            'message' => 'success',
            'movie' => Movie::find($movieId)
        ]);
    }

    public function deleteMovie(Request $request)
    {
        $movie_id = $request->movie_id;
        $movie = Movie::find($movie_id);
        $movie->delete();

        return response()->json([
            'message' => 'success',
            'movie_id' => $movie_id
        ]);
    }

    public function updateMovie(Request $request)
    {
        $movie_id = $request->movie_id;
        $movie = Movie::where('id', $movie_id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'imdb_url' => $request->imdb_url,
            'image_url' => $request->image_url,
            'release_date' => $request->release_date,
            'banner_url' => $request->banner_url,
        ]);


        return response()->json([
            'message' => 'success',
            'movie_id' => $movie_id,
            'movie' => $movie
        ]);
    }
}
