<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');

Route::get('movie-category', 'MovieCategoryController@index');
Route::get('movie', 'MovieController@index');
Route::get('movie-category/{movie_category}', 'MovieCategoryController@show');

Route::middleware('auth:sanctum', 'role:admin')->group(function () {
    Route::get('user', 'UserController@show');
    Route::apiResource('movie-category', 'MovieCategoryController')->except('index', 'show');
    Route::post('logout', function (Request $request) {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    });
});