<?php

namespace App\Http\Controllers\Api;

use App\Models\Movie;
use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();
        $playlist = Playlist::create([
            'playlist_name' => $request->playlist_name,
            'description' => $request->description,
            'user_id' => $user->id
        ]);

        return response()->json([
            'message' => 'success',
            'playlist' => $playlist
        ]);
    }

    public function toggleMovie(Request $request)
    {
        $movie_id = $request->movie_id;
        $playlist_id = $request->playlist_id;

        $playlist = Playlist::find($playlist_id)
            ->getRelatedMovies()
            ->toggle([$movie_id]);

        return response()->json([
            'message' => 'success',
            'playlist' => $playlist
        ]);
    }

    public function getPlaylistMovies(Request $request)
    {
        $playlist_id = $request->playlist_id;

        $movies = Playlist::find($playlist_id)
            ->getRelatedMovies()->get();

        return response()->json([
            'message' => 'success',
            'movies' => $movies
        ]);
    }

    public function update(Request $request)
    {
        $playlist_id = $request->playlist_id;
        $user = $request->user();
        $playlist = Playlist::where('id', $playlist_id)
            ->update([
                    'playlist_name' => $request->playlist_name,
                    'description' => $request->description,
                    'user_id' => $user->id
                ]
            );

        return response()->json([
            'message' => 'success',
            'playlist' => $playlist
        ]);
    }

    public function delete(Request $request)
    {
        $playlist_id = $request->playlist_id;
        $playlist = Playlist::find('id', $playlist_id);
        $playlist->delete();

        return response()->json([
           'message' => 'success',
           'playlist_id' => $playlist_id
        ]);
    }

    public function getUserPlaylists(Request $request)
    {
        $user = $request->user();
        $playlists = $user->getPlaylists()->get();

        return response()->json([
            'message' => 'success',
            'playlists' => $playlists
        ]);
    }

    public function getListOfFeaturedPlaylists()
    {

        return response()->json([
            'message' => 'success',
            'playlists' => Playlist::with('getRelatedMovies')
                ->orderByDesc('subscribers')
                ->take(10)
                ->get()
        ]);
    }

    public function togglePlaylistSubscription(Request $request)
    {
        $playlist_id = $request->playlist_id;
        $user = $request->user();
        Playlist::find($playlist_id)
            ->subscribers()->toggle([$user->id]);;

        return response()->json([
            'message' => 'success'
        ]);
    }

    public function getPlaylistDetail(Request $request)
    {
        $playlist_id = $request->playlist_id;
        $playlist = Playlist::where('id', $playlist_id)
            ->with('getRelatedMovies')
            ->with('author')
            ->with('subscribers')
            ->first();

        return response()->json([
            'message' => 'success',
            'playlist' => $playlist
        ]);
    }
}
