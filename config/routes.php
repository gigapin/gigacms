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

use App\Controllers\Admin\CategoryController;
use App\Controllers\HomeController;
use App\Controllers\TestsController;
use App\Controllers\Admin\PostController;
use App\Controllers\Admin\LoginController;
use App\Controllers\Admin\RegisterController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\LibraryController;
use App\Controllers\Admin\TagController;
use App\Controllers\Backend\SettingController;

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

/** TAGS */
$route->post('/tags/delete/{slug}', [TagController::class, 'delete']);

/** TEST PHP */
$route->get('/tests', [TestsController::class, 'index']);

