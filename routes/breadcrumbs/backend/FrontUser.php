<?php
/**
 * Created by Dhruv.
 * User: Developer
 * Date: 20-Jan-19
 * Time: 4:20 PM
 */

Breadcrumbs::for('admin.front-user.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Manage User', route('admin.front-user.index'));
});

Breadcrumbs::for('admin.front-user.create', function ($trail) {
    $trail->parent('admin.front-user.index');
    $trail->push('Create User', route('admin.front-user.create'));
});

Breadcrumbs::for('admin.front-user.edit', function ($trail,$id) {
    $trail->parent('admin.front-user.index');
    $trail->push('Edit User', route('admin.front-user.edit',$id));
});

