<?php

use App\Http\Controllers\Admin\Category\AdminCategoryController;
use App\Http\Controllers\Admin\Post\AdminPostController;
use App\Http\Controllers\Admin\Tag\TagController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Post\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::get('/', [App\Http\Controllers\Main\IndexController::class, 'index'])->name('main.index');

Route::group(['prefix' => 'posts'], function () {
    Route::get('/', [PostController::class, 'index'])->name('post.index');
    Route::group(['prefix' => '{post}'], function () {
        Route::get('/', [PostController::class, 'show'])->name('post.show');
        Route::post('comments', [PostController::class, 'comment'])->name('post.comment.store');
        Route::post('likes', [PostController::class, 'like'])->name('post.like.store');
    });
});


Route::group(['prefix' => 'personal', 'middleware' => ['auth', 'verified']], function () {
    Route::group(['prefix' => 'main', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', [\App\Http\Controllers\Personal\Main\IndexController::class, 'index'])->name('personal.main.index');
    });
    Route::group(['prefix' => 'liked', 'middleware' => ['auth', 'verified']], function () {
        Route::get('/', [\App\Http\Controllers\Personal\Liked\IndexController::class, 'index'])->name('personal.liked.index');
        Route::delete('/{post}', [\App\Http\Controllers\Personal\Liked\DeletedController::class, 'delete'])->name('personal.liked.delete');
    });
    Route::group(['prefix' => 'comments', 'middleware' => ['auth', 'verified']], function () {
        Route::get('/', [\App\Http\Controllers\Personal\Comment\IndexController::class, 'index'])->name('personal.comment.index');
        Route::get('/{comment}/edit', [\App\Http\Controllers\Personal\Comment\IndexController::class, 'edit'])->name('personal.comment.edit');
        Route::patch('/{comment}', [\App\Http\Controllers\Personal\Comment\IndexController::class, 'update'])->name('personal.comment.update');
        Route::delete('/{comment}', [\App\Http\Controllers\Personal\Comment\IndexController::class, 'delete'])->name('personal.comment.delete');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', [\App\Http\Controllers\Admin\Main\AdminMainController::class, 'index'])->name('admin.main.index');

Route::group(['prefix' => 'users'], function () {
    Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('/', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('/{user}', [UserController::class, 'show'])->name('admin.user.show');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::patch('/{user}', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('/{user}', [UserController::class, 'delete'])->name('admin.user.delete');
});

Route::group(['prefix' => 'posts'], function () {
    Route::get('/', [AdminPostController::class, 'index'])->name('admin.post.index');
    Route::get('/create', [AdminPostController::class, 'create'])->name('admin.post.create');
    Route::post('/', [AdminPostController::class, 'store'])->name('admin.post.store');
    Route::get('/{post}', [AdminPostController::class, 'show'])->name('admin.post.show');
    Route::get('/{post}/edit', [AdminPostController::class, 'edit'])->name('admin.post.edit');
    Route::patch('/{post}', [AdminPostController::class, 'update'])->name('admin.post.update');
    Route::delete('/{post}', [AdminPostController::class, 'delete'])->name('admin.post.delete');
});

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', [AdminCategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/create', [AdminCategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/', [AdminCategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/{category}', [AdminCategoryController::class, 'show'])->name('admin.category.show');
    Route::get('/{category}/edit', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
    Route::patch('/{category}', [AdminCategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('/{category}', [AdminCategoryController::class, 'delete'])->name('admin.category.delete');
});

Route::group(['prefix' => 'tags'], function () {
    Route::get('/', [TagController::class, 'index'])->name('admin.tag.index');
    Route::get('/create', [TagController::class, 'create'])->name('admin.tag.create');
    Route::post('/', [TagController::class, 'store'])->name('admin.tag.store');
    Route::get('/{tag}', [TagController::class, 'show'])->name('admin.tag.show');
    Route::get('/{tag}/edit', [TagController::class, 'edit'])->name('admin.tag.edit');
    Route::patch('/{tag}', [TagController::class, 'update'])->name('admin.tag.update');
    Route::delete('/{tag}', [TagController::class, 'delete'])->name('admin.tag.delete');
});
});

