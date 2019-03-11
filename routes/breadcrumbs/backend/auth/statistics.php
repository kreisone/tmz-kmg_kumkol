<?php

Breadcrumbs::for('admin.auth.statistics.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.service_of_security.statistics.main'), route('admin.auth.statistics.index'));
});