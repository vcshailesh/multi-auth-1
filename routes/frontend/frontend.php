<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 16-Jan-19
 * Time: 10:11 PM
 */


Route::get('/','FrontendController@index');

Route::group(['prefix' => 'frontend','middleware' => 'auth:web'], function () {
    Route::get('/dashboard','FrontendController@dashboard')->name('dashboard');
});

