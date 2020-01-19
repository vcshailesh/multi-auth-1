<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 02-Feb-19
 * Time: 04:47 PM
 */

Route::group([
    // 'middleware' => ['auth:admin','role:admin|user'],
], function () {
    Route::group(['namespace' => 'FrontUser','middleware' => 'check_user_is_active'], function () {
         
        /*  For DataTables */
         Route::any('/front-user-lists', 'FrontUserTableController')->name('front-user.lists');

         Route::resource('/front-user', 'FrontUserController')->except(['show','destroy']);
         Route::get('/front-user-delete/{frontUser}','FrontUserController@destroy')->name('front-user.destroy');

        Route::any('front-user/change-status', 'FrontUserController@changeStatus')->name('front-user.change-status');
        Route::any('front-user/destroy','FrontUserController@destroy')->name('front-user.destroy');
        Route::any('front-user/bulk-action','FrontUserController@bulkAction')->name('front-user.bulk-action');
    });
});