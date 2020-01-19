<?php
/**
 * Created by Dhruv.
 * User: Developer
 * Date: 20-Jan-19
 * Time: 4:20 PM
 */

Breadcrumbs::for('admin.admin-user.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Manage User', route('admin.admin-user.index'));
});

Breadcrumbs::for('admin.admin-user.create', function ($trail) {
    $trail->parent('admin.admin-user.index');
    $trail->push('Create User', route('admin.admin-user.create'));
});

Breadcrumbs::for('admin.admin-user.edit', function ($trail,$id) {
    $trail->parent('admin.admin-user.index');
    $trail->push('Edit User', route('admin.admin-user.edit',$id));
});

