<?php

Breadcrumbs::for('admin.auth.login', function ($trail) {
    $trail->push('Admin Login', route('admin.auth.login'));
});

Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push(__('lables.backend.dashboard'), route('admin.dashboard'));
});

require __DIR__.'/AdminUser.php';
require __DIR__.'/FrontUser.php';
require __DIR__.'/Role.php';
require __DIR__.'/Permission.php';
