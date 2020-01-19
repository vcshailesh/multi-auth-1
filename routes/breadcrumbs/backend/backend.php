<?php

Breadcrumbs::for('admin.auth.login', function ($trail) {
    $trail->push('Admin Login', route('admin.auth.login'));
});

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('lables.backend.dashboard'), route('admin.dashboard'));
});


require __DIR__.'/front-user.php';
require __DIR__.'/role.php';
require __DIR__.'/permission.php';
