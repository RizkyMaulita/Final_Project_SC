<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('pertanyaans','PertanyaanController');
Route::resource('jawabans','JawabanController');
// Route::resource('komentarpertanyaans','KomentarPertanyaanController');
Route::get('pertanyaans/komentar', 'KomentarPertanyaanController@create');
Route::put('pertanyaans','KomentarPertanyaanController@store');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
