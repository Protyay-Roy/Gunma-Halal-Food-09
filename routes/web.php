<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';



Route::prefix('admin')->group(function () {
    //-----------------------------------        VIEW LOGIN PAGE AND GET LOGIN REQUEST FOR ADMIN
    Route::match(['get', 'post'], 'login', [AdminController::class, 'login']);

    Route::group(['middleware' => ['admin']], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

        Route::get('view-admin', [AdminController::class, 'adminList'])->name('view.admin');

        Route::match(['get', 'post'], 'add-edit-admin/{email?}', [AdminController::class, 'addEditAdmin'])->name('add-edit.admin');

        // CHANGE ADMIN STATUS
        Route::post('admin-status', [AdminController::class, 'status']);
        // DELETE ADMIN (TYPE==VENDOR)
        Route::get('delete-admin/{admin}', [AdminController::class, 'destroy'])->name('delete-admin');

        // VIEW PROFILE
        Route::view('profile', 'admin.profile.view_profile')->name('profile');

        // UPDATE ADMIN PROFILE IMAGE
        Route::post('upload-image', [AdminController::class, 'uploadImage'])->name('upload_image');

        // VIEW UPDATE PROFILE PAGE
        Route::view('update-profile', 'admin.profile.update_profile')->name('view-update-profile');

        // UPDATE ADMIN PROFILE
        Route::post('update-own-profile', [AdminController::class, 'updateProfile'])->name('update-own-profile');

        // UPDATE ADMIN PROFILE
        Route::post('change-password', [AdminController::class, 'changePassword'])->name('change-password');

        // VIEW CATEGORY LISTING PAGE
        Route::get('category', [CategoryController::class, 'index'])->name('category');
        // Route::view('category', 'admin.category.category_list')->name('category');

        // CHANGE ADMIN STATUS
        Route::post('category-status', [CategoryController::class, 'status']);

        // ADD-EDIT CATEGORY
        Route::match(['get', 'post'], 'add-edit-category/{slug?}', [CategoryController::class, 'addEditCategory'])->name('add-edit.category');
    });
});
