<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\AdminController;
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

Route::get('/movie/featured', [MovieController::class, 'getFeaturedMovies']);
Route::get('/movie/popular', [MovieController::class, 'getPopularMovies']);
Route::get('/movie/info', [MovieController::class, 'getMovieInfo']);
Route::post('/movie/favorites', [MovieController::class, 'addOrRemoveToFavoriteMovie']);
Route::get('/movie/favorites', [MovieController::class, 'getFavoriteMovies']);

Route::post('/admin/movie/create', [AdminController::class, 'createMovie']);
Route::get('/admin/movie/list', [AdminController::class, 'getListOfMovies']);
Route::get('/admin/movie', [AdminController::class, 'getMovie']);
Route::put('/admin/movie/update', [AdminController::class, 'updateMovie']);
Route::delete('/admin/movie/delete', [AdminController::class, 'deleteMovie']);
