<?php

Breadcrumbs::for('admin.auth.material.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.pass_bureau.materials.main'), route('admin.auth.material.index'));
});

Breadcrumbs::for('admin.auth.material.edit.show', function ($trail, $id) {
    $trail->parent('admin.auth.material.index');
    $trail->push(__('menus.backend.pass_bureau.materials.edit'), route('admin.auth.material.edit.show', $id));
});

Breadcrumbs::for('admin.auth.material.add.show', function ($trail) {
    $trail->parent('admin.auth.material.index');
    $trail->push(__('menus.backend.pass_bureau.materials.add'), route('admin.auth.material.add.show'));
});

Breadcrumbs::for('admin.auth.material.search', function ($trail) {
    $trail->parent('admin.auth.material.index');
    $trail->push(__('menus.backend.pass_bureau.search'), route('admin.auth.material.search'));
});
