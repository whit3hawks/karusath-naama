<?php

use App\Http\Controllers\Backend\AdvController;
use App\Http\Controllers\Backend\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\MediaPhotoController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\NewsQuoteController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\VideoController;
use App\Http\Controllers\Frontend\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::domain(config('app.url'))->group(function () {
  Route::get('/', [HomeController::class, 'index'])->middleware('throttle:200,2');
  Route::get('/news/latest', [HomeController::class, 'latest'])->middleware('throttle:200,2');
  Route::get('/search/news', [HomeController::class, 'search'])->middleware('throttle:20,5');
  Route::get('/{slug}', [HomeController::class, 'tag'])->middleware('throttle:200,2');
  Route::get('/galleries/{id}', [HomeController::class, 'galleries'])->middleware('throttle:200,2');;
  Route::get('/videos/{id}', [HomeController::class, 'videos'])->middleware('throttle:200,2');;
  Route::get('/quotes/{id}', [HomeController::class, 'quotes'])->middleware('throttle:200,2');;
  Route::get('/authors/{id}', [HomeController::class, 'authors'])->middleware('throttle:200,2');;
  Route::get('/shot/news/{id}', [NewsController::class, 'shot']);
  //Route::get('/shot/news/{id}/make', [NewsController::class, 'generateShareImage']);
  Route::get('/shot/quote/{id}', [NewsQuoteController::class, 'shot']);
  //Route::get('/shot/quote/{id}/make', [NewsQuoteController::class, 'generateShot']);
  Route::post('/comment', [HomeController::class, 'comment'])->middleware('throttle:10,1');
  Route::get('/voice/our-team', [HomeController::class, 'ourTeam'])->middleware('throttle:20,2');
});

Route::get('/login', [LoginController::class, 'login'])->name('boli.login');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::domain('boli.' . config('app.url'))->name(config('app.admindomain') . '.')->group(function () {
  Route::get('/', function () {
    return redirect('/login');
  });
  Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
  Route::post('/login', [LoginController::class, 'auth'])->name('auth');
  Route::resource('/galleries', GalleryController::class)->middleware('auth');
  Route::get('/galleries/{id}/status', [GalleryController::class, 'status'])->name('galleries.status')->middleware('auth');
  Route::post('/galleries/{id}/images', [GalleryController::class, 'image'])->name('galleries.images.store')->middleware('auth');
  Route::get('/galleries/{id}/images/{imageid}/delete', [GalleryController::class, 'imageDelete'])->name('galleries.images.delete')->middleware('auth');
  Route::resource('/videos', VideoController::class)->middleware('auth');
  Route::get('/videos/{id}/status', [VideoController::class, 'status'])->name('videos.status')->middleware('auth');
  Route::resource('/news-quotes', NewsQuoteController::class)->middleware('auth');
  Route::get('/news-quotes/{id}/status', [NewsQuoteController::class, 'status'])->name('news-quotes.status')->middleware('auth');
  Route::resource('/news', NewsController::class)->middleware('auth');
  Route::get('/news/{id}/status', [NewsController::class, 'status'])->name('news.status')->middleware('auth');
  Route::get('/news/{id}/tweet', [NewsController::class, 'tweet'])->name('news.tweet')->middleware('auth');
  Route::get('/news-published', [NewsController::class, 'publishedNews'])->name('news.published-news')->middleware('auth');
  Route::get('/news-editorbox', [NewsController::class, 'editorBoxNews'])->name('news.editorbox-news')->middleware('auth');
  Route::get('/news/{id}/live-blog', [NewsController::class, 'liveBlogIndex'])->name('news.live-blog.index')->middleware('auth');
  Route::post('/news/{id}/live-blog', [NewsController::class, 'liveBlogStore'])->name('news.live-blog.store')->middleware('auth');
  Route::get('/news/{id}/live-blog/{blogid}/delete', [NewsController::class, 'liveBlogDelete'])->name('news.live-blog.delete')->middleware('auth');
  Route::get('/news/{id}/send-to-draft', [NewsController::class, 'sendToDraft'])->name('news.send-to-draft')->middleware('auth');
  Route::get('/remove-breakings', [NewsController::class, 'removeBreakings'])->name('news.remove-breaking')->middleware('auth');
  Route::post('/upload-news-image', [NewsController::class, 'uploadImage'])->name('news.upload-news-image')->middleware('auth');
  Route::resource('/tags', TagController::class)->middleware('auth');
  Route::post('/tags/{id}/add-sub-tag', [TagController::class, 'addSubTag'])->name('tags.add-sub-tag')->middleware('auth');
  Route::get('/tags/{id}/remove-sub-tag/{sub_tag_id}', [TagController::class, 'removeSubTag'])->name('tags.remove-sub-tag')->middleware('auth');
  Route::resource('/permissions', PermissionController::class)->middleware('auth');
  Route::resource('/roles', RoleController::class)->middleware('auth');
  Route::get('/roles/{id}/permission/{permission}', [RoleController::class, 'addPermission'])->name('roles.add.permission')->middleware('auth');
  Route::get('/roles/{id}/permission/{permission}/remove', [RoleController::class, 'removePermission'])->name('roles.remove.permission')->middleware('auth');
  Route::resource('/users', UserController::class)->middleware('auth');
  Route::get('/users/{id}/login-log', [UserController::class, 'loginLog'])->name('users.login-log')->middleware('auth');
  Route::get('/users/{id}/role/{role}', [UserController::class, 'addRole'])->name('users.add.role')->middleware('auth');
  Route::get('/users/{id}/role/{role}/remove', [UserController::class, 'removeRole'])->name('users.remove.role')->middleware('auth');
  Route::resource('/advs', AdvController::class)->middleware('auth');
  Route::get('/advs/{id}/status', [AdvController::class, 'status'])->name('advs.status')->middleware('auth');
  Route::resource('/comments', CommentController::class)->middleware('auth');
  Route::get('/comments/{id}/status', [CommentController::class, 'status'])->name('comments.status')->middleware('auth');
  Route::get('/migrate-old-db', [NewsController::class, 'oldMigration'])->middleware('auth');
  Route::resource('/media-photos', MediaPhotoController::class)->middleware('auth');
});
