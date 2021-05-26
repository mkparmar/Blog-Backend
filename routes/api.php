<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\LoginController;


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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/articles', [ArticlesController::class, 'getArticles'])->middleware('auth:sanctum');
Route::post('/save-article', [ArticlesController::class, 'createArticle'])->middleware('auth:sanctum');
Route::post('/delete-article', [ArticlesController::class, 'deleteArticle'])->middleware('auth:sanctum');
Route::post('/get-article', [ArticlesController::class, 'articleDetails'])->middleware('auth:sanctum');
Route::post('/update-article', [ArticlesController::class, 'updateArticle'])->middleware('auth:sanctum');


Route::post('/login', [LoginController::class, 'login']);
