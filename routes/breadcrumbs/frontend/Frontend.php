<?php

Breadcrumbs::for('frontend.auth.login', function ($trail) {
    $trail->push('User Login', route('frontend.auth.login'));
});

Breadcrumbs::for('frontend.user.dashboard', function ($trail) {
    $trail->push('User Dashboard', route('frontend.user.dashboard'));
});

