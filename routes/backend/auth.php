<?php

use App\Http\Controllers\Backend\Auth\Role\RoleController;
use App\Http\Controllers\Backend\Auth\User\UserController;
use App\Http\Controllers\Backend\Auth\User\UserAccessController;
use App\Http\Controllers\Backend\Auth\User\UserSocialController;
use App\Http\Controllers\Backend\Auth\User\UserStatusController;
use App\Http\Controllers\Backend\Auth\User\UserSessionController;
use App\Http\Controllers\Backend\Auth\User\UserPasswordController;
use App\Http\Controllers\Backend\Auth\User\UserConfirmationController;

use App\Http\Controllers\Backend\User\MaterialController;
use App\Http\Controllers\Backend\User\GroupOfPersonnelController;
use App\Http\Controllers\Backend\User\ShopfloorController;
use App\Http\Controllers\Backend\User\StatisticsController;
use App\Http\Controllers\Backend\ConfigController;



/*
 * Routing for admin
 */
Route::group([
    'prefix'     => 'auth',
    'as'         => 'auth.',
    'namespace'  => 'Auth',
    'middleware' => 'role:'.config('access.users.admin_role'),
], function () {
    /*
     * User Management
     */
    Route::group(['namespace' => 'User'], function () {

        /*
         * User Status'
         */
        Route::get('user/deactivated', [UserStatusController::class, 'getDeactivated'])->name('user.deactivated');
        Route::get('user/deleted', [UserStatusController::class, 'getDeleted'])->name('user.deleted');

        /*
         * User CRUD
         */
        Route::get('user', [UserController::class, 'index'])->name('user.index');
        Route::get('user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('user', [UserController::class, 'store'])->name('user.store');

        /*
         * Specific User
         */
        Route::group(['prefix' => 'user/{user}'], function () {
            // User
            Route::get('/', [UserController::class, 'show'])->name('user.show');
            Route::get('edit', [UserController::class, 'edit'])->name('user.edit');
            Route::patch('/', [UserController::class, 'update'])->name('user.update');
            Route::delete('/', [UserController::class, 'destroy'])->name('user.destroy');

            // Account
            Route::get('account/confirm/resend', [UserConfirmationController::class, 'sendConfirmationEmail'])->name('user.account.confirm.resend');

            // Status
            Route::get('mark/{status}', [UserStatusController::class, 'mark'])->name('user.mark')->where(['status' => '[0,1]']);

            // Social
            Route::delete('social/{social}/unlink', [UserSocialController::class, 'unlink'])->name('user.social.unlink');

            // Confirmation
            Route::get('confirm', [UserConfirmationController::class, 'confirm'])->name('user.confirm');
            Route::get('unconfirm', [UserConfirmationController::class, 'unconfirm'])->name('user.unconfirm');

            // Password
            Route::get('password/change', [UserPasswordController::class, 'edit'])->name('user.change-password');
            Route::patch('password/change', [UserPasswordController::class, 'update'])->name('user.change-password.post');

            // Access
            Route::get('login-as', [UserAccessController::class, 'loginAs'])->name('user.login-as');

            // Session
            Route::get('clear-session', [UserSessionController::class, 'clearSession'])->name('user.clear-session');

            // Deleted
            Route::get('delete', [UserStatusController::class, 'delete'])->name('user.delete-permanently');
            Route::get('restore', [UserStatusController::class, 'restore'])->name('user.restore');
        });
    });

    /*
     * Role Management
     */
    Route::group(['namespace' => 'Role'], function () {
        Route::get('role', [RoleController::class, 'index'])->name('role.index');
        Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
        Route::post('role', [RoleController::class, 'store'])->name('role.store');

        Route::group(['prefix' => 'role/{role}'], function () {
            Route::get('edit', [RoleController::class, 'edit'])->name('role.edit');
            Route::patch('/', [RoleController::class, 'update'])->name('role.update');
            Route::delete('/', [RoleController::class, 'destroy'])->name('role.destroy');
        });
    });


    /*
     * Configuration file of web-site to change a look
     */
    Route::group(['namespace' => 'Config'], function() {

        Route::get('index', [ConfigController::class, 'index'])->name('config.index');
        Route::post('save', [ConfigController::class, 'save'])->name('config.save');

    });

});


/*
 * Routing for worker of pass bureau
 */

Route::group([
    // 'prefix'     => 'auth',
    'as'         => 'auth.',
    'namespace'  => 'Auth',
    'middleware' => 'role:'.config('access.users.pass_bureau_role'),
], function () {

    
    /*
     * Material Management
     */
    Route::group(['namespace' => 'Material'], function() {

        Route::get('material', [MaterialController::class, 'index'])->name('material.index');
        
        // Delete Material
        Route::get('material/delete/{id}', [MaterialController::class, 'deleteMaterial'])
            ->where('id', '[0-9]+')
            ->name('material.delete');

        // Edit Material
        Route::get('material/edit/{id}', [MaterialController::class, 'showEditMaterial'])
            ->where('id', '[0-9]+')
            ->name('material.edit.show');

        Route::post('material/edit/{id}', [MaterialController::class, 'editMaterial'])
            ->where('id', '[0-9]+')
            ->name('material.edit');


        // Add Material
        Route::get('material/add', [MaterialController::class, 'showAddMaterial'])->name('material.add.show');
        Route::post('material/add/{title?}', [MaterialController::class, 'addMaterial'])
            ->name('material.add');


        // Search Material
        Route::get('material/search', [MaterialController::class, 'searchMaterial'])->name('material.search');




    });

    /*
     *  Group of Personnel
     */
    Route::group(['namespace' => 'GroupOfPersonnel'], function() {

        Route::get('group_of_personnel/{shopfloor?}', [GroupOfPersonnelController::class, 'index'])
            ->where('shopfloor', '[0-9]+')
            ->name('group_of_personnel.index');

        // Delete Group Of Personnel
        Route::get('group_of_personnel/delete/{id}', [GroupOfPersonnelController::class, 'deleteGroupOfPersonnel'])
            ->where('id', '[0-9]+')
            ->name('group_of_personnel.delete');

        // Edit Group Of Personnel
        Route::get('group_of_personnel/edit/{id}', [GroupOfPersonnelController::class, 'showEditGroupOfPersonnel'])
            ->where('id', '[0-9]+')
            ->name('group_of_personnel.edit.show');

        Route::post('group_of_personnel/edit/{id}', [GroupOfPersonnelController::class, 'editGroupOfPersonnel'])
            ->where('id', '[0-9]+')
            ->name('group_of_personnel.edit');


        // Add Group Of Personnel
        Route::get('group_of_personnel/add', [GroupOfPersonnelController::class, 'showAddGroupOfPersonnel'])->name('group_of_personnel.add.show');
        Route::post('group_of_personnel/add/{title?}', [GroupOfPersonnelController::class, 'addGroupOfPersonnel'])
            ->name('group_of_personnel.add');


        // Search Group Of Personnel
        Route::get('group_of_personnel/search', [GroupOfPersonnelController::class, 'searchGroupOfPersonnel'])->name('group_of_personnel.search');



        // Adding material to the group of personnel
        Route::get('group_of_personnel/add_mat_to_group', [GroupOfPersonnelController::class, 'showAddMaterialToGroup'])->name('group_of_personnel.add_mat_to_group.show');
        Route::post('group_of_personnel/add_mat_to_group', [GroupOfPersonnelController::class, 'addMaterialToGroup'])->name('group_of_personnel.add_mat_to_group');
        
        // Getting groups of personnel
        Route::get('group_of_personnel/add_mat_to_group/get_group_of_personnel', [GroupOfPersonnelController::class, 'getGroupOfPersonnel'])->name('group_of_personnel.get_group_of_personnel');
        // Getting materials 
        Route::get('group_of_personnel/add_mat_to_group/get_material', [GroupOfPersonnelController::class, 'getMaterial'])->name('group_of_personnel.get_material');




         // Adding worker to the group of personnel
        Route::get('group_of_personnel/add_worker_to_group', [GroupOfPersonnelController::class, 'showAddWorkerToGroup'])->name('group_of_personnel.add_worker_to_group.show');
        Route::post('group_of_personnel/add_worker_to_group', [GroupOfPersonnelController::class, 'addWorkerToGroup'])->name('group_of_personnel.add_worker_to_group');


        // Getting shopfloors
        Route::get('group_of_personnel/add_worker_to_group/get_shopfloor', [GroupOfPersonnelController::class, 'getShopfloor'])->name('group_of_personnel.get_shopfloor');
        // Getting groups of personnel by worker
        Route::get('group_of_personnel/add_worker_to_group/get_group_of_personnel', [GroupOfPersonnelController::class, 'getGroupOfPersonnelByWorker'])->name('group_of_personnel.get_group_of_personnel_by_worker');

    });


    /*
     *  Shopfloor
     */
    Route::group(['namespace' => 'Shopfloor'], function() {

        Route::get('shopfloor', [ShopfloorController::class, 'index'])
            ->name('shopfloor.index');

        // Delete Shopfloor
        Route::get('shopfloor/delete/{id}', [ShopfloorController::class, 'deleteShopfloor'])
            ->where('id', '[0-9]+')
            ->name('shopfloor.delete');

        // Edit Shopfloor
        Route::get('shopfloor/edit/{id}', [ShopfloorController::class, 'showEditShopfloor'])
            ->where('id', '[0-9]+')
            ->name('shopfloor.edit.show');

        Route::post('shopfloor/edit/{id}', [ShopfloorController::class, 'editShopfloor'])
            ->where('id', '[0-9]+')
            ->name('shopfloor.edit');


        // Add Shopfloor
        Route::get('shopfloor/add', [ShopfloorController::class, 'showAddShopfloor'])->name('shopfloor.add.show');
        Route::post('shopfloor/add/{title?}', [ShopfloorController::class, 'addShopfloor'])
            ->name('shopfloor.add');


        // Search Shopfloor
        Route::get('shopfloor/search', [ShopfloorController::class, 'searchShopfloor'])->name('shopfloor.search');

    });




});


/*
 * Routing for worker of service of security
 */

Route::group([
    // 'prefix'     => 'auth',
    'as'         => 'auth.',
    'namespace'  => 'Auth',
    'middleware' => 'role:'.config('access.users.service_of_security_role'),
], function () {

    /*
     * 
     */
    Route::group(['namespace' => 'Statistics'], function() {

        // 
        Route::get('statistics', [StatisticsController::class, 'index'])->name('statistics.index');


    });


});