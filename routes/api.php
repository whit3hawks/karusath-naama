<?php

use App\Http\Controllers\Backend\MediaPhotoController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\TagController;
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

Route::get('/search-photos/{keyword}', [MediaPhotoController::class, 'searchPhotos']);
Route::post('/news/{id}/auto-save', [NewsController::class, 'autoSave']);
Route::domain('boli.' . config('app.url'))->name(config('app.admindomain') . '.')->group(function () {
    Route::get('/tag-search/{slug}', [TagController::class, 'search']);
    Route::post('/news-tag/{id}', [NewsController::class, 'storeTag']);
    Route::get('/news-tag/{id}', [NewsController::class, 'getTags']);
    Route::get('/news-tag/{id}/delete', [NewsController::class, 'deleteTag']);
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
