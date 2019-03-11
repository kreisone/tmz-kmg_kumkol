<?php

Breadcrumbs::for('admin.auth.shopfloor.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('menus.backend.pass_bureau.shopfloor.main'), route('admin.auth.shopfloor.index'));
});

Breadcrumbs::for('admin.auth.shopfloor.edit.show', function ($trail, $id) {
    $trail->parent('admin.auth.shopfloor.index');
    $trail->push(__('menus.backend.pass_bureau.shopfloor.edit'), route('admin.auth.shopfloor.edit.show', $id));
});

Breadcrumbs::for('admin.auth.shopfloor.add.show', function ($trail) {
    $trail->parent('admin.auth.shopfloor.index');
    $trail->push(__('menus.backend.pass_bureau.shopfloor.add'), route('admin.auth.shopfloor.add.show'));
});

Breadcrumbs::for('admin.auth.shopfloor.search', function ($trail) {
    $trail->parent('admin.auth.shopfloor.index');
    $trail->push(__('menus.backend.pass_bureau.search'), route('admin.auth.shopfloor.search'));
});
