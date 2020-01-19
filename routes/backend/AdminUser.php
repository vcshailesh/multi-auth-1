<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 02-Feb-19
 * Time: 04:47 PM
 */

Route::group([
    'middleware' => 'auth:admin',
], function () {
    Route::group(['namespace' => 'AdminUser','middleware' => 'check_user_is_active'], function () {
         
        /*  For DataTables */
         Route::any('/admin-user-lists', 'AdminUserTableController')->name('admin-user.lists');

         Route::resource('/admin-user', 'AdminUserController')->except('show');
         Route::get('/admin-user-delete/{adminUser}','AdminUserController@destroy')->name('admin-user.destroy');

        Route::any('admin-user/change-status', 'AdminUserController@changeStatus')->name('admin-user.change-status');
        Route::any('admin-user/destroy','AdminUserController@destroy')->name('admin-user.destroy');
        Route::any('admin-user/bulk-action','AdminUserController@bulkAction')->name('admin-user.bulk-action');
    });
});