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

Route::get('/', 'LoginController@check');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::get('/confirm/id={id}&validate={validate}', 'LoginController@confirm')->name('confirm');


// not login urls
Route::group(['middleware' => ['notLogin']], function () {
    // login view
    Route::get('/login', function () {
        return view('login');
    })->name('login.view');

    // login post
    Route::post('/login', 'LoginController@login')->name('login');

    // register view
    Route::get('/register', function () {
        return view('register');
    })->name('register.view');

    // register post
    Route::post('/register', 'LoginController@register')->name('register');


});



Route::group(['prefix' => 'admin','namespace' => 'admin','middleware' => ['login','Admin']], function () {
    Route::get('dashboard', 'AdminController@Dashboard')->name('admin.dashboard');
    Route::get('userinfo/{id}', 'AdminController@UserInfo')->name('user.info');
    Route::get('delete/{id}', 'AdminController@DeleteUser')->name('user.delete');
    Route::PUT('UserUpdate', 'AdminController@UserUpdate')->name('admin.user.update');
});

Route::group(['prefix' => 'user','namespace' => 'user','middleware' => ['login','User']], function () {
    Route::get('dashboard', 'UserController@Dashboard')->name('user.dashboard');
    Route::get('SendConfirmMail/id={id}', 'UserController@SendConfirmMail')->name('SendConfirmMail');
    Route::PUT('EditProfile', 'UserController@EditProfile')->name('EditProfile');
});