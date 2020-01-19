<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 02-Feb-19
 * Time: 04:47 PM
 */

Route::group([
    'middleware' => 'auth:admin,check_user_is_active',
], function () {
    Route::group([
        'namespace' => 'Permission',
    ], function () {

        /*  For DataTables */
        Route::any('/permission-lists', 'PermissionTableController')->name('permission.lists');

        Route::resource('/permission', 'PermissionController')->except('show');

        Route::any('permission/change-status', 'PermissionController@changeStatus')->name('permission.change-status');
        Route::any('permission/destroy', 'PermissionController@destroy')->name('permission.destroy');
        Route::any('permission/bulk-action', 'PermissionController@bulkAction')->name('permission.bulk-action');
    });
});