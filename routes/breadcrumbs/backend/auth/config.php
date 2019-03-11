<?php

Breadcrumbs::for('admin.auth.config.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.config.main'), route('admin.auth.config.index'));
});