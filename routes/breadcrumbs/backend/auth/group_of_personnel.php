<?php

Breadcrumbs::for('admin.auth.group_of_personnel.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.pass_bureau.group_of_personnel.main'), route('admin.auth.group_of_personnel.index'));
});

Breadcrumbs::for('admin.auth.group_of_personnel.edit.show', function ($trail, $id) {
    $trail->parent('admin.auth.group_of_personnel.index');
    $trail->push(__('menus.backend.pass_bureau.group_of_personnel.edit'), route('admin.auth.group_of_personnel.edit.show', $id));
});

Breadcrumbs::for('admin.auth.group_of_personnel.add.show', function ($trail) {
    $trail->parent('admin.auth.group_of_personnel.index');
    $trail->push(__('menus.backend.pass_bureau.group_of_personnel.add'), route('admin.auth.group_of_personnel.add.show'));
});

Breadcrumbs::for('admin.auth.group_of_personnel.search', function ($trail) {
    $trail->parent('admin.auth.group_of_personnel.index');
    $trail->push(__('menus.backend.pass_bureau.search'), route('admin.auth.group_of_personnel.search'));
});

Breadcrumbs::for('admin.auth.group_of_personnel.add_mat_to_group.show', function ($trail) {
    $trail->parent('admin.auth.group_of_personnel.index');
    $trail->push(__('menus.backend.pass_bureau.group_of_personnel.add_mat_to_group'), route('admin.auth.group_of_personnel.add_mat_to_group.show'));
});

Breadcrumbs::for('admin.auth.group_of_personnel.add_worker_to_group.show', function ($trail) {
    $trail->parent('admin.auth.group_of_personnel.index');
    $trail->push(__('menus.backend.pass_bureau.group_of_personnel.add_worker_to_group'), route('admin.auth.group_of_personnel.add_worker_to_group.show'));
});
