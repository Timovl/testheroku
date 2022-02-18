<?php

use Illuminate\Support\Facades\Route;

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
    return view('home');
});


Auth::routes(['/register' => false]);


Route::get('/home', 'HomeController@index')->name('home');
Route::get('course', 'CourseController@index');

Route::middleware(['auth'])->prefix('')->group(function () {
    Route::redirect('/course/{id}', '/');
    Route::get('course/{id}', 'CourseController@show');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::redirect('/', '/admin/programmes');
    Route::resource('programmes', 'Admin\ProgrammeController');
    Route::get('programmes/{id}', 'Admin\ProgrammeController@inex');
});

//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
//
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
//
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');

