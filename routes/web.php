<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\GroupController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\UserController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Models\Post;
use App\Models\User;
use App\Models\Group;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false,
]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    // post
    Route::prefix('post')->name('post.')->middleware('can:post')->group(function () {
        // Route::get('/', [PostController::class, 'index'])->name('index')->can('viewAny', Post::class);
        Route::get('/', [PostController::class, 'index'])->name('index');
        // create
        // Route::get('/create', [PostController::class, 'create'])->name('create')->can('create', Post::class);
        // Route::post('/create', [PostController::class, 'postCreate'])->can('create', Post::class);
        Route::get('/create', [PostController::class, 'create'])->name('create')->can('post.add');
        Route::post('/create', [PostController::class, 'postCreate'])->can('post.add');
        // update
        Route::get('/update/{post}', [PostController::class, 'update'])->name('update')->can('post.edit');
        Route::post('/update', [PostController::class, 'postUpdate'])->name('post-update')->can('post.edit');
        // delete
        Route::get('/delete/{post}', [PostController::class, 'delete'])->name('delete')->can('post.delete');
    });
    // product
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
    });
    // group
    Route::prefix('group')->name('group.')->middleware('can:group')->group(function () {
        Route::get('/', [GroupController::class, 'index'])->name('index');
        // create
        Route::get('/create', [GroupController::class, 'create'])->name('create')->can('group.add');
        Route::post('/create', [GroupController::class, 'postCreate'])->can('group.add');
        // update
        Route::get('/update/{group}', [GroupController::class, 'update'])->name('update')->can('group.edit');
        Route::post('/update', [GroupController::class, 'postUpdate'])->name('post-update')->can('group.edit');
        // delete
        Route::get('/delete/{group}', [GroupController::class, 'delete'])->name('delete')->can('group.delete');
        // permission
        Route::get('/permission/{group}', [GroupController::class, 'permission'])->name('permission')->can('group.permission');
        Route::post('/permission/{group}', [GroupController::class, 'postPermission'])->can('group.permission');
    });
    // user
    Route::prefix('user')->name('user.')->middleware('can:user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        // create
        Route::get('/create', [UserController::class, 'create'])->name('create')->can('user.add');
        Route::post('/create', [UserController::class, 'postCreate'])->can('user.add');
        // update
        Route::get('/update/{user}', [UserController::class, 'update'])->name('update')->can('user.edit');
        Route::post('/update', [UserController::class, 'postUpdate'])->name('post-update')->can('user.edit');
        // delete
        Route::get('/delete/{user}', [UserController::class, 'delete'])->name('delete')->can('user.delete');
    });
});
