<?php
/*
 * This file is part of the GiGaCMS package.
 *
 * (c) Giuseppe Galari <gigaprog@proton.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

/** @var $route */

use App\Controllers\Admin\RoleController;
use App\Controllers\HomeController;
use App\Controllers\TestsController;
use App\Controllers\Admin\TagController;
use App\Controllers\Admin\MenuController;
use App\Controllers\Admin\PostController;
use App\Controllers\Admin\RolePermissionController;
use App\Controllers\Admin\UserController;
use App\Controllers\Admin\LoginController;
use App\Controllers\Admin\LibraryController;
use App\Controllers\Admin\CategoryController;
use App\Controllers\Admin\MenuItemController;
use App\Controllers\Admin\RegisterController;
use App\Controllers\Admin\RevisionController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\SettingController;
use App\Api\v1\Controllers\TestController;
use App\Api\v1\Controllers\ApiPostController;
use App\Api\v1\Controllers\ApiMenuItemsController;
use App\Api\v1\Controllers\ApiCategoryController;
use App\Api\v1\Controllers\ApiMenuController;

/** 
 * API 
 * 
*/

$route->get('/api/v1/test', [TestController::class, 'index']);
$route->get('/api/v1/posts', [ApiPostController::class, 'index']);
$route->get('/api/v1/blog', [ApiPostController::class, 'blog']);
$route->get('/api/v1/posts/{slug}', [ApiPostController::class, 'show']);
$route->get('/api/v1/menuitems', [ApiMenuItemsController::class, 'index']);
$route->get('/api/v1/categories', [ApiCategoryController::class, 'index']);
$route->get('/api/v1/categories/{slug}', [ApiCategoryController::class, 'show']);
$route->get('/api/v1/menus', [ApiMenuController::class, 'index']);

/** HOME */
$route->get('/', [HomeController::class, 'index']);

$route->get('/login', [LoginController::class, 'login']);
$route->get('/logout', [LoginController::class, 'logout']);
$route->post('/signin', [LoginController::class, 'signin']);
$route->get('/register', [RegisterController::class, 'register']);
$route->post('/signup', [RegisterController::class, 'signup']);

/** DASHBOARD */
$route->get('/dashboard', [DashboardController::class, 'index']);

/** LIBRARY */
$route->get('/library', [LibraryController::class, 'index']);
$route->post('/library', [LibraryController::class, 'store']);
$route->post('/library/{id}', [LibraryController::class, 'delete']);

/** POSTS */
$route->get('/posts', [PostController::class, 'index']);
$route->get('/posts/create', [PostController::class, 'create']);
$route->post('/posts', [PostController::class, 'store']);
$route->get('/posts/edit/{id}', [PostController::class, 'edit']);
$route->post('/posts/{id}', [PostController::class, 'update']);
$route->post('/posts/delete/{id}', [PostController::class, 'delete']);
$route->get('/posts/{slug}', [PostController::class, 'show']);
$route->post('/posts/restore/{id}', [PostController::class, 'restore']);

/** MENUS */
$route->get('/menus', [MenuController::class, 'index']);
$route->get('/menus/create', [MenuController::class, 'create']);
$route->post('/menus', [MenuController::class, 'store']);
$route->get('/menus/edit/{id}', [MenuController::class, 'edit']);
$route->post('/menus/{id}', [MenuController::class, 'update']);
$route->post('/menus/delete/{id}', [MenuController::class, 'delete']);

/** MENU ITEMS */
$route->get('/menu-items', [MenuItemController::class, 'index']);
$route->get('/menu-items/create', [MenuItemController::class, 'create']);
$route->post('/menu-items', [MenuItemController::class, 'store']);
$route->get('/menu-items/edit/{id}', [MenuItemController::class, 'edit']);
$route->post('/menu-items/{id}', [MenuItemController::class, 'update']);
$route->post('/menu-items/delete/{id}', [MenuItemController::class, 'delete']);

/** CATEGORIES */
$route->get('/categories', [CategoryController::class, 'index']);
$route->get('/categories/create', [CategoryController::class, 'create']);
$route->post('/categories', [CategoryController::class, 'store']);
$route->get('/categories/edit/{slug}', [CategoryController::class, 'edit']);
$route->post('/categories/{id}', [CategoryController::class, 'update']);
$route->post('/categories/delete/{id}', [CategoryController::class, 'delete']);

/** SETTINGS */
$route->get('/settings', [SettingController::class, 'index']);
$route->get('/settings/create', [SettingController::class, 'create']);
$route->post('/settings', [SettingController::class, 'store']);
$route->post('/settings/clean-cache', [SettingController::class, 'cleanCache']);

/** TAGS */
$route->post('/tags/delete/{slug}', [TagController::class, 'delete']);

/** TEST PHP */
$route->get('/tests', [TestsController::class, 'index']);

/** REVISIONS */
$route->get('/revisions/{id}', [RevisionController::class, 'index']);
$route->get('/revisions/preview/{id}', [RevisionController::class, 'preview']);
$route->post('/revisions/restore/{id}', [RevisionController::class, 'restore']);
$route->post('/revisions/delete/{id}', [RevisionController::class, 'delete']);

/** USERS */
$route->get('/users', [UserController::class, 'index']);
$route->get('/users/create', [UserController::class, 'create']);
$route->post('/users', [UserController::class, 'store']);
$route->get('/users/edit/{id}', [UserController::class, 'edit']);
$route->post('/users/{id}', [UserController::class, 'update']);
$route->post('/users/delete/{id}', [UserController::class, 'delete']);

/** ROLES */
$route->post('/roles', [RoleController::class, 'store']);
$route->post('/roles/delete/{id}', [RoleController::class, 'delete']);

/** ROLE PERMISSIONS */
// $route->get('/role-permissions', [RolePermission::class, 'index']);
// $route->get('/role-permissions/create', [RolePermission::class, 'create']);
// $route->post('/role-permissions', [RolePermission::class, 'store']);
// $route->get('/role-permissions/edit/{id}', [RolePermission::class, 'edit']);
// $route->post('/role-permissions/{id}', [RolePermission::class, 'update']);
// $route->post('/role-permissions/change/{id}', [RolePermission::class, 'change']);
// $route->post('/role-permissions/delete/{id}', [RolePermission::class, 'delete']);
// $route->get('/role-permissions/restore', [RolePermission::class, 'restoreDefaultPermission']);

