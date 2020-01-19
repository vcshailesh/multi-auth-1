<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 16-Jan-19
 * Time: 10:11 PM
 */

Route::group(['namespace' => 'Auth','as' => 'auth.'], function () {

    Route::get('/',function (){
        return redirect(route('admin.auth.login'));
    });
    // Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login')->name('login.post');
    Route::post('logout', 'LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register')->name('register.post');

    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');

});

Route::get('dashboard','BackendController@index')->name('dashboard');
