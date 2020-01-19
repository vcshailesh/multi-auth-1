<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 20-Jan-19
 * Time: 4:20 PM
 */

Breadcrumbs::for('admin.user.permission.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Manage Role', route('admin.user.permission.index'));
});

Breadcrumbs::for('admin.user.permission.create', function ($trail) {
    $trail->parent('admin.user.permission.index');
    $trail->push('Create Role', route('admin.user.permission.create'));
});

Breadcrumbs::for('admin.user.permission.edit', function ($trail,$id) {
    $trail->parent('admin.user.permission.index');
    $trail->push('Edit Role', route('admin.user.permission.edit',$id));
});

