<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PlaylistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/auth/status', [AuthController::class, 'status']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::put('/auth/change-personal-data', [AuthController::class, 'changeUserData']);

Route::post('/user/subscribe', [UserController::class, 'subscribe']);
Route::get('user/followers', [UserController::class, 'getUserFollowers']);
Route::get('user/subscriptions', [UserController::class, 'getUserSubscriptions']);

Route::post('playlists/store', [PlaylistController::class, 'store']);
Route::put('playlists/update', [PlaylistController::class, 'update']);
Route::delete('playlists/delete', [PlaylistController::class, 'delete']);
Route::get('playlists', [PlaylistController::class, 'getUserPlaylists']);

Route::get('/movie/featured', [MovieController::class, 'getFeaturedMovies']);
Route::get('/movie/popular', [MovieController::class, 'getPopularMovies']);
Route::get('/movie/last-released', [MovieController::class, 'getLastReleasedMovies']);
Route::get('/movie/info', [MovieController::class, 'getMovieInfo']);
Route::post('/movie/favorites', [MovieController::class, 'addOrRemoveToFavoriteMovie']);
Route::get('/movie/favorites', [MovieController::class, 'getFavoriteMovies']);
Route::get('/movie/search', [MovieController::class, 'search']);
Route::get('/movie/similar', [MovieController::class, 'similar']);

Route::post('/admin/movie/create', [UserController::class, 'createMovie']);
Route::get('/admin/movie/list', [UserController::class, 'getListOfMovies']);
Route::get('/admin/movie', [UserController::class, 'getMovie']);
Route::put('/admin/movie/update', [UserController::class, 'updateMovie']);
Route::delete('/admin/movie/delete', [UserController::class, 'deleteMovie']);
Route::get('/admin/movie/all', [UserController::class, 'getAllMovies']);


Route::post('/admin/genre/create', [UserController::class, 'createGenre']);
Route::get('/admin/genre/list', [UserController::class, 'getListOfGenres']);
Route::get('/admin/genre', [UserController::class, 'getGenre']);
Route::put('/admin/genre/update', [UserController::class, 'updateGenre']);
Route::delete('/admin/genre/delete', [UserController::class, 'deleteGenre']);
Route::post('/admin/genre/toggle', [UserController::class, 'attachOrToggleMovie']);
