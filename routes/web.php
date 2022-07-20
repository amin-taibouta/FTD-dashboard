<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

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
		$updateDate = [
			':id' => $user->id,
			':name' => $user->name,
			':last_name' => $user->last_name,
			':username' => $user->username,
			':password' => Hash::make($user->password),
			':email' => $user->email,
			':updated_at' => $user->updated_at
		];
		try {
			DB::select(DB::raw("EXEC dbo.DTP_Users_UpdateUser 
				@id = :id, 
				@name = :name, 
				@last_name = :last_name, 
				@email = :email, 
				@username = :username,
				@email_verified_at = null,
				@password = :password,
				@remember_token = null,
				@updated_at = :updated_at,
				@orgs = null"
			), $updateDate);
		} catch (QueryException $e) {
		}
    }
	dd('done ' . count($users) . ' updated');
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
	
	/*DB::select(DB::raw("EXEC dbo.DTP_Users_UpdateUser 
				@id = 1, 
				@name = 'Eric', 
				@last_name = 'Ettel', 
				@email = 'eettel@futuredontics.com', 
				@username = 'eric.ettel',
				@email_verified_at = null,
				@password = 'Eric',
				@remember_token = null,
				@updated_at = '2022-07-13 13:04:19',
				@orgs = null"
			));

	DB::select(DB::raw("EXEC dbo.DTP_Users_UpdateUser 
				@id = 2, 
				@name = 'Matt', 
				@last_name = 'Zivkovic', 
				@email = 'matt@futuredontics.com', 
				@username = 'matthew.zivkovic',
				@email_verified_at = null,
				@password = 'Matt',
				@remember_token = null,
				@updated_at = '2022-07-19 13:04:19',
				@orgs = null"
			));

	DB::select(DB::raw("EXEC dbo.DTP_Users_UpdateUser 
				@id = 3, 
				@name = 'Woody', 
				@last_name = 'Woodard', 
				@email = 'woody@futuredontics.com', 
				@username = 'woody.woodard',
				@email_verified_at = null,
				@password = 'Woody',
				@remember_token = null,
				@updated_at = '2022-07-13 13:04:19',
				@orgs = null"
			));*/
			
	dd(DB::select( DB::raw("SET NOCOUNT ON; exec dbo.DTP_Users_SelectUser")));
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
