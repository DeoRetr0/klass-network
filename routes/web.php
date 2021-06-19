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
    'as'=>'auth.SignUp',
    'middleware'=>'guest'
]);
Route::post('/signup', [
    'uses'=>'\App\Http\Controllers\AuthController@postSignup',
    'middleware'=>'guest'
]);
/*
 * SIGN-IN // LOGAR // SAIR/SIGNOUT //PASSWORD RESET 
 */
Route::get('/login', [
    'uses'=>'\App\Http\Controllers\AuthController@getLogin',
    'as'=>'auth.Login',
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

Route::get('/forget-password', 'ForgotPasswordController@getEmail')->name('auth.PasswordForget');
Route::post('/forget-password', 'ForgotPasswordController@postEmail')->name('auth.PasswordForget');

Route::get('/reset-password/{token}', 'ResetPasswordController@getPassword')->name('auth.PasswordReset');
Route::post('/reset-password', 'ResetPasswordController@updatePassword')->name('auth.PasswordReset');

/*
 * SEARCH // BUSCA
 */
Route::get('/search', [
    'uses'=>'\App\Http\Controllers\SearchController@getResults',
    'as'=>'search.Buscar',
]);
/*
 * PERFIL DO USUARIO
 */
Route::get('/user/{username}', [
    'uses'=>'\App\Http\Controllers\ProfileController@getProfile',
    'as'=>'profile.Perfil',
]);
Route::get('/user/{username}/followers', [
    'uses'=>'\App\Http\Controllers\FriendController@getFriends',
    'as'=>'profile.Followers',
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
Route::post('/mudarImagem', 'ProfileController@atualizarImagem');
Route::post('/mudarBanner', 'ProfileController@atualizarBanner');

/*
 * AMIGOS
 */
Route::get('/followers', [
    'uses'=>'\App\Http\Controllers\FriendController@getIndex',
    'as'=>'friends.Solicitacoes',
    'middleware'=>['auth'],
]);
Route::get('/follow/add/{username}', [
    'uses'=>'\App\Http\Controllers\FriendController@getAdd',
    'as'=>'friends.add',
    'middleware'=>['auth'],
]);
Route::get('/follow/accept/{username}', [
    'uses'=>'\App\Http\Controllers\FriendController@getAccept',
    'as'=>'friends.accept',
    'middleware'=>['auth'],
]);
Route::post('/follow/delete/{username}', [
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
    'uses'=>'\App\Http\Controllers\StatusController@postLike',
    'as'=>'status.like',
    'middleware'=>['auth'],
]);
Route::get('/status/{statusId}/likes', [
    'uses'=>'\App\Http\Controllers\StatusController@getLike',
]);

//Route::group(['middleware' => 'auth'], function(){
//Aí dentro de um group você coloca todas as rotas chamando diretamente
//e nao precisa passar de uma em uma
//Route::get('/josu-lindo','JosueController@EuSouLindo')->name('josue.de.paulo.duro');
//})

/*
 * CONFIGURAÇÕES
 */
Route::get('/config', [
    'uses'=>'\App\Http\Controllers\ProfileController@getConfig',
    'as'=>'config.Config',
    'middleware'=>['auth'],
]);

