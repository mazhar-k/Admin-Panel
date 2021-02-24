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
    return view('welcome');
});

Route::get('/dashboard','PagesController@index');

Route::get('/teams','PagesController@teams');

Route::get('/analytics','PagesController@analytics');

Route::get('/blogs/{category_id}/searchByCategory','BlogsController@searchByCategory');

Route::get('/blogs/searchByTag','BlogsController@searchByTag');

Route::get('/blogs/searchBar','BlogsController@searchBar');

Route::get('/teams/quintet','TeamsController@quintet');

Route::get('/teams/admins','TeamsController@admins');

Route::get('/teams/heads','TeamsController@heads');

Route::get('/teams/filterByTeam','TeamsController@filterByTeam');

Route::get('/deals/{sponsor_id}/create','DealsController@create');

Route::post('/deals/{sponsor_id}','DealsController@store');

Route::delete('/deals/{deal_id}/{sponsor_id}','DealsController@destroy');

Route::get('/download_mou/{deal_id}', 'DealsController@downloadMou');

Route::resource('blogs','BlogsController');

Route::resource('events','EventsController');

Route::resource('marketing','SponsorsController');

Route::resource('deals', 'DealsController')->except([
    'create','store','destroy'
]);

Route::resource('media','MediaController');

Route::resource('teams','TeamsController');

Route::post('/register_user', 'HomeController@storeAccessId');

Auth::routes();

Route::get('/home', function(){
    return redirect('/dashboard');
});


