<?php

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
Route::get('/', 'IndexController@index');
Route::get('/dashboard', 'IndexController@dashboard');
Route::get('/about', 'IndexController@about');
Route::get('/test.php', function (){
  return view('test');
});
Route::get('/profile/{id}', 'ProfileController@show');
Route::put('/profile/{id}', 'ProfileController@update');

Route::post('/comments', 'CommentController@store');
Route::put('/comments/{id}', 'CommentController@update');
Route::delete('/comments/{id}', 'CommentController@destroy');

Route::resource('posts', 'PostController');

// Auth
// Authentication Routes...
Route::get('login', [
  'as' => 'login',
  'uses' => 'Auth\LoginController@showLoginForm'
]);
Route::post('login', [
  'as' => '',
  'uses' => 'Auth\LoginController@login'
]);
Route::post('logout', [
  'as' => 'logout',
  'uses' => 'Auth\LoginController@logout'
]);

// Registration Routes...
Route::get('register', [
  'as' => 'register',
  'uses' => 'Auth\RegisterController@showRegistrationForm'
]);
Route::post('register', [
  'as' => '',
  'uses' => 'Auth\RegisterController@register'
]);