<?php

use GuzzleHttp\Psr7\Request;
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



//ini route buat jawaban

//akhir route jawaban

Route::resource('pertanyaans','PertanyaanController');
Route::resource('jawabans','JawabanController');
Route::resource('pertanyaans.komentarpertanyaans','KomentarPertanyaanController');
Route::resource('jawabans.komentarjawabans','KomentarJawabanController');
Route::resource('pertanyaans.jawabans','JawabanController');
Route::resource('pertanyaans.vote','VoteController');

// Route::put('pertanyaans','KomentarPertanyaanController@store');
//Route::put('/pertanyaans/{id}/show', 'KomentarPertanyaanController@create');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



