<?php
/**
 * Created by PhpStorm.
 * User: Developer
 * Date: 20-Jan-19
 * Time: 4:20 PM
 */

Breadcrumbs::for('admin.role.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Manage Role', route('admin.role.index'));
});

Breadcrumbs::for('admin.role.create', function ($trail) {
    $trail->parent('admin.role.index');
    $trail->push('Create Role', route('admin.role.create'));
});

Breadcrumbs::for('admin.role.edit', function ($trail,$id) {
    $trail->parent('admin.role.index');
    $trail->push('Edit Role', route('admin.role.edit',$id));
});

