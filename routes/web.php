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

/*
 * HOME
 */
Route::get('/', [
    'uses'=>'\App\Http\Controllers\HomeController@index',
    'as'=>'home',
]);
/*
 * ALERTS
 */
Route::get('/alert', function(){
    return redirect()->route('home')->with('info', 'Você logou!');
});
/*
 * SIGN-UP // CADASTRAR
 */
Route::get('/signup', [
    'uses'=>'\App\Http\Controllers\AuthController@getSignup',
    'as'=>'auth.signup',
    'middleware'=>'guest'
]);
Route::post('/signup', [
    'uses'=>'\App\Http\Controllers\AuthController@postSignup',
    'middleware'=>'guest'
]);
/*
 * SIGN-IN // LOGAR // SAIR/SIGNOUT
 */
Route::get('/login', [
    'uses'=>'\App\Http\Controllers\AuthController@getLogin',
    'as'=>'auth.login',
    'middleware'=>'guest'
]);
Route::post('/login', [
    'uses'=>'\App\Http\Controllers\AuthController@postLogin',
    'middleware'=>'guest'
]);
Route::get('/signout', [
    'uses'=>'\App\Http\Controllers\AuthController@getSignout',
    'as'=>'auth.signout'
]);
/*
 * SEARCH // BUSCA
 */
Route::get('/search', [
    'uses'=>'\App\Http\Controllers\SearchController@getResults',
    'as'=>'search.results',
]);
/*
 * PERFIL DO USUARIO
 */
Route::get('/user/{email}', [
    'uses'=>'\App\Http\Controllers\ProfileController@getProfile',
    'as'=>'profile.index',
]);
Route::get('/user/{email}/friends', [
    'uses'=>'\App\Http\Controllers\FriendController@getFriends',
    'as'=>'profile.friends',
]);

Route::get('/profile/edit', [
   'uses'=>'\App\Http\Controllers\ProfileController@getEdit',
    'as'=>'profile.edit',
    'middleware'=>['auth'],
]);
Route::post('/profile/edit', [
    'uses'=>'\App\Http\Controllers\ProfileController@postEdit',
    'middleware'=>['auth'],
]);

/*
 * AMIGOS
 */
Route::get('/friends', [
    'uses'=>'\App\Http\Controllers\FriendController@getIndex',
    'as'=>'friends.index',
    'middleware'=>['auth'],
]);
Route::get('/friends/add/{email}', [
    'uses'=>'\App\Http\Controllers\FriendController@getAdd',
    'as'=>'friends.add',
    'middleware'=>['auth'],
]);
Route::get('/friends/accept/{email}', [
    'uses'=>'\App\Http\Controllers\FriendController@getAccept',
    'as'=>'friends.accept',
    'middleware'=>['auth'],
]);
Route::post('/friends/delete/{email}', [
    'uses'=>'\App\Http\Controllers\FriendController@postDelete',
    'as'=>'friends.delete',
    'middleware'=>['auth'],
]);
/*
 * STATUS
 */
Route::post('/status', [
    'uses'=>'\App\Http\Controllers\StatusController@postStatus',
    'as'=>'status.post',
    'middleware'=>['auth'],
]);
Route::post('/status/{statusId}/reply', [
    'uses'=>'\App\Http\Controllers\StatusController@postReply',
    'as'=>'status.reply',
    'middleware'=>['auth'],
]);
Route::get('/status/{statusId}/like', [
    'uses'=>'\App\Http\Controllers\StatusController@getLike',
    'as'=>'status.like',
    'middleware'=>['auth'],
]);

