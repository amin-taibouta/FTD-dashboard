<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
Route::get('/fix-users', function () {
    $users = DB::select( DB::raw("SET NOCOUNT ON; exec dbo.DTP_Users_SelectUser"));
    foreach($users as $user)  {
        DB::raw("SET NOCOUNT ON; exec dbo.DTP_Users_UpdateUser", 
            [
                'id' => $user->id,
                'offices' => "99999,88888"
            ]
        );
    }
});

Route::get('/users', function () {
	/*EXEC dbo.DTP_CallsList
	@user_id = 1,
	@offices = NULL,
	@orgs = NULL,
	@start = '2022-07-06',
	@end = '2022-07-12'*/
	//dd(DB::select( DB::raw("SET NOCOUNT ON; exec dbo.DTP_CallsList @start = '2022-07-06', @end = '2022-07-12' ")));

	/*DB::raw("SET NOCOUNT ON; exec dbo.DTP_Users_InsertUser @name = :name, @last_name = :lastName, @email = :email, @username = :username, @password = :password "), 
		[
			':email' => 'woody@futuredontics.com',
			':password' => Hash::make('woody'),
			':name' => 'Woody',
			':lastName' => 'Woodard',
			':username' => 'woody.woodard'
		]
	);*/
	//dd(DB::select( DB::raw("SET NOCOUNT ON; exec dbo.DTP_Users_SelectUser")));
});

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
