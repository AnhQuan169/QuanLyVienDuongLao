<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ThongBaoController;

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

// ===================Client=============================
Route::get('/', [HomeController::class, 'index']);



// ========================Admin==============================
Route::get('/admin', [AdminController::class, 'index'])->name('login_admin');
Route::post('/login-admin', [AdminController::class, 'login_admin']);
Route::get('/logout-admin', [AdminController::class, 'logout_admin'])->name('logout_admin');


Route::middleware('admin')->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'show_dashboard'])->name('dashboard');

    // ---------------Quản lí thông báo---------------
    Route::prefix('thongbao')->group(function(){
        Route::get('/all-notification', [ThongBaoController::class, 'all_notification'])->name('all_notification');
        Route::get('all-notification/fetch_data', [ThongBaoController::class, 'fetch_data']);
        Route::get('/add-notification', [ThongBaoController::class, 'add_notification'])->name('add_notification');
        // Lưu thông báo mới
        Route::post('/save-notification', [ThongBaoController::class, 'save_notification'])->name('save_notification');
        // Chỉnh sửa thông báo
        Route::get('/edit-notification/{id}', [ThongBaoController::class, 'edit_notification'])->name('notification.edit');
        Route::post('/update-notification/{id}', [ThongBaoController::class, 'update_notification'])->name('notification.update');
        // Xoá thông báo
        Route::delete('/delete-notification/{id}', [ThongBaoController::class, 'delete_notification'])->name('notification.delete');
    });
});
