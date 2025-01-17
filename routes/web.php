<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Auth\LoginController;


Route::get('/', function () {
    return view('welcome');
});


// Frontend Routes
Route::get('/home', [FrontendController::class, 'index']);
Route::get('faculty/{category_slug}', [FrontendController::class, 'ViewCategoryPost']);
Route::get('faculty/{category_slug}/{post_slug}', [FrontendController::class, 'ViewPost']);

//Comment System
Route::post('comments', [App\Http\Controllers\Frontend\CommentController::class,'store']);
Route::post('delete-comment',[App\Http\Controllers\Frontend\CommentController::class,'destroy']);

// Auth Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register-submit', [RegisterController::class, 'register'])->name('register.submit');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login-submit', [LoginController::class, 'login'])->name('login.submit');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function() {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Category Routes
    Route::get('faculty', [CategoryController::class, 'index']);
    Route::get('add-faculty', [CategoryController::class, 'create']);
    Route::post('add-faculty', [CategoryController::class, 'store']);
    Route::get('edit-category/{category_id}', [CategoryController::class, 'edit']);
    Route::put('update-category/{category_id}', [CategoryController::class, 'update']);
    Route::get('delete-category/{category_id}', [CategoryController::class, 'destroy']);

    // Post Routes
    Route::get('post', [PostController::class, 'index']);
    Route::get('add-post', [PostController::class, 'create'])->name('admin.add-post');
    Route::post('add-post', [PostController::class, 'store']);
    Route::get('edit-post/{post_id}', [PostController::class, 'edit']);
    Route::put('edit-post/{post_id}', [PostController::class, 'update']);
    Route::get('delete-post/{post_id}', [PostController::class, 'destroy']);

    // User Routes
    Route::get('users', [UsersController::class, 'index']);
    Route::get('edit-users/{users_id}', [UsersController::class, 'edit']);
    Route::put('edit-users/{users_id}', [UsersController::class, 'update']);

    Route::get('settings', [SettingsController::class, 'index']); // Show the settings form
    Route::put('settings', [SettingsController::class, 'update']); // Handle the form submission



});

// AJAX Route
Route::get('/admin/get-levels/{categoryId}', [PostController::class, 'getLevels'])->name('admin.get-levels');
