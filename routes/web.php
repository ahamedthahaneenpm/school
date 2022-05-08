<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [Auth\LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [Auth\LoginController::class, 'destroy'])->name('logout');

    Route::prefix('dashboard')->name('dashboard_')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('home');
    });

    /**
     * Dashboard management
     */
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    /**
     * Role management
     */
    Route::prefix('role')->name('role_')->group(function () {
        Route::get('/', [RolesController::class, 'listRoles'])->name('list');
        Route::post('table', [RolesController::class, 'rolesListData'])->name('table');
        Route::get('add', [RolesController::class, 'addRole'])->name('add');
        Route::post('create', [RolesController::class, 'createRole'])->name('create');
        Route::get('edit', [RolesController::class, 'editRole'])->name('edit');
        Route::post('update', [RolesController::class, 'updateRole'])->name('update');
        Route::post('status_change', [RolesController::class, 'statusChange'])->name('status_change');
        Route::get('delete', [RolesController::class, 'deleteRole'])->name('delete');
    });

    /**
     * User management
     */
    Route::prefix('user')->name('user_')->group(function () {
        Route::get('/', [UsersController::class, 'listUsers'])->name('list');
        Route::post('table', [UsersController::class, 'userListData'])->name('table');
        Route::get('add', [UsersController::class, 'addUser'])->name('add');
        Route::post('create', [UsersController::class, 'createUser'])->name('create');
        Route::get('edit', [UsersController::class, 'editUser'])->name('edit');
        Route::post('update', [UsersController::class, 'updateUser'])->name('update');
        Route::post('update_password', [UsersController::class, 'updateUserPassword'])->name('update_password');
        Route::post('status_change', [UsersController::class, 'statusChange'])->name('status_change');
        Route::get('delete', [UsersController::class, 'deleteUser'])->name('delete');
    });

    /**
     * Settings management
     */
    Route::prefix('settings')->name('settings_')->group(function () {
        Route::get('/', [SettingsController::class, 'view'])->name('view');
        Route::post('general/save', [SettingsController::class, 'saveGeneral'])->name('general_save');
        Route::get('favicon/remove', [SettingsController::class, 'removeFavicon'])->name('remove_favicon');
        Route::get('dark_logo/remove', [SettingsController::class, 'removeDarkLogo'])->name('remove_dark_logo');
        Route::get('light_logo/remove', [SettingsController::class, 'removeLightLogo'])->name('remove_light_logo');
        Route::post('link', [SettingsController::class, 'linkSave'])->name('link_save');
    });

    /**
     * Teachers management
     */
    Route::prefix('teacher')->name('teacher_')->group(function () {
        Route::get('/', [TeachersController::class, 'list'])->name('list');
        Route::post('table', [TeachersController::class, 'table'])->name('table');
        Route::get('view', [TeachersController::class, 'view'])->name('view');
        Route::get('add', [TeachersController::class, 'add'])->name('add');
        Route::post('save', [TeachersController::class, 'save'])->name('save');
        Route::get('edit', [TeachersController::class, 'edit'])->name('edit');
        Route::post('update', [TeachersController::class, 'update'])->name('update');
        Route::get('delete', [TeachersController::class, 'delete'])->name('delete');
        Route::post('status', [TeachersController::class, 'status'])->name('status');
    });

    /**
     * Students management
     */
    Route::prefix('student')->name('student_')->group(function () {
        Route::get('/', [StudentsController::class, 'list'])->name('list');
        Route::post('table', [StudentsController::class, 'table'])->name('table');
        Route::get('view', [StudentsController::class, 'view'])->name('view');
        Route::get('add', [StudentsController::class, 'add'])->name('add');
        Route::post('save', [StudentsController::class, 'save'])->name('save');
        Route::get('edit', [StudentsController::class, 'edit'])->name('edit');
        Route::post('update', [StudentsController::class, 'update'])->name('update');
        Route::get('delete', [StudentsController::class, 'delete'])->name('delete');
        Route::post('status', [StudentsController::class, 'status'])->name('status');
    });

    /**
     * Scores management
     */
    Route::prefix('score')->name('score_')->group(function () {
        Route::get('/', [ScoresController::class, 'list'])->name('list');
        Route::post('table', [ScoresController::class, 'table'])->name('table');
        Route::get('view', [ScoresController::class, 'view'])->name('view');
        Route::get('add', [ScoresController::class, 'add'])->name('add');
        Route::post('save', [ScoresController::class, 'save'])->name('save');
        Route::get('edit', [ScoresController::class, 'edit'])->name('edit');
        Route::post('update', [ScoresController::class, 'update'])->name('update');
        Route::get('delete', [ScoresController::class, 'delete'])->name('delete');
        Route::post('status', [ScoresController::class, 'status'])->name('status');
    });

    /**
     * Options management
     */
    Route::prefix('options')->name('options_')->group(function () {
        Route::get('students', [OptionsController::class, 'students'])->name('students');
        Route::get('teachers', [OptionsController::class, 'teachers'])->name('teachers');
    });
});