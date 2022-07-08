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
    if (!Auth::check()) {
        return redirect('/login');
    } else {
        return redirect('/dashboard');
    }
});

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/callsdatatables', 'CallsReportController@callsDatatables')->name('callsdatatables');

//Auth::routes(['register' => false]);

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/calls-report', 'CallsReportController@index')->name('calls-report');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');
