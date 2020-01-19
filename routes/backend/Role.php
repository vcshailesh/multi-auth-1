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
    Route::group([
        'namespace' => 'Role',
    ], function () {

        /*  For DataTables */
        Route::any('/role-lists', 'RoleTableController')->name('role.lists');

        Route::resource('/role', 'RoleController')->except('show');
        Route::get('/role-delete/{role}', 'RoleController@destroy')->name('role.destroy');

        Route::any('role/change-status', 'RoleController@changeStatus')->name('role.change-status');
        Route::any('role/destroy', 'RoleController@destroy')->name('role.destroy');
        Route::any('role/bulk-action', 'RoleController@bulkAction')->name('role.bulk-action');
    });
});