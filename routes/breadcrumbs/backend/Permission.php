<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 20-Jan-19
 * Time: 4:20 PM
 */

Breadcrumbs::for('admin.permission.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Manage Role', route('admin.permission.index'));
});

Breadcrumbs::for('admin.permission.create', function ($trail) {
    $trail->parent('admin.permission.index');
    $trail->push('Create Role', route('admin.permission.create'));
});

Breadcrumbs::for('admin.permission.edit', function ($trail,$id) {
    $trail->parent('admin.permission.index');
    $trail->push('Edit Role', route('admin.permission.edit',$id));
});

