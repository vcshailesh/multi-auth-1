<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 20-Jan-19
 * Time: 4:20 PM
 */

Breadcrumbs::for('admin.user.role.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Manage Role', route('admin.user.role.index'));
});

Breadcrumbs::for('admin.user.role.create', function ($trail) {
    $trail->parent('admin.user.role.index');
    $trail->push('Create Role', route('admin.user.role.create'));
});

Breadcrumbs::for('admin.user.role.edit', function ($trail,$id) {
    $trail->parent('admin.user.role.index');
    $trail->push('Edit Role', route('admin.user.role.edit',$id));
});

