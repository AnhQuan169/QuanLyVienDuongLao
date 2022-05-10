<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DangKyThamQuanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HoSoNguoiCaoTuoiController;
use App\Http\Controllers\ThongBaoController;
use App\Http\Controllers\UserController;

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
    // ----------------- Quản lý Đăng ký tham quan trung tâm----------------
    Route::prefix('dangkythamquan')->group(function(){
        // === Quản lý danh sách đơn đăng ký
        Route::get('/all-registerToVisit', [DangKyThamQuanController::class, 'all_registerToVisit'])->name('registerToVisit.all');
        Route::get('/add-registerToVisit', [DangKyThamQuanController::class, 'add_registerToVisit'])->name('registerToVisit.add');
        // Lưu đăng ký tham quan mới
        Route::post('/save-registerToVisit', [DangKyThamQuanController::class, 'save_registerToVisit'])->name('registerToVisit.save');
        // Xem chi tiết đơn đăng ký tham quan trung tâm
        Route::get('/detail-registerToVisit/{id}', [DangKyThamQuanController::class, 'detail_registerToVisit'])->name('registerToVisit.detail');
        // Route::post('/update-registerToVisit/{id}', [DangKyThamQuanController::class, 'update_registerToVisit'])->name('registerToVisit.update');
        // Xoá đăng ký tham quan trung tâm
        Route::delete('/delete-registerToVisit/{id}', [DangKyThamQuanController::class, 'delete_registerToVisit'])->name('registerToVisit.delete');
        
        // === Duyệt đơn đăng ký đang chờ duyệt
        Route::get('/browse-application', [DangKyThamQuanController::class, 'browse_application'])->name('browseapplication.all');
        Route::get('/detail-browse-application/{id}', [DangKyThamQuanController::class, 'detail_browse_application'])->name('browseapplication.detail');
        Route::get('/save-browse-application/{id}', [DangKyThamQuanController::class, 'save_browse_application'])->name('browseapplication.save');
    });
    
    // ---------------------Quản lý người dùng--------------------------
    Route::prefix('nguoidung')->group(function(){
        // === Quản lý danh sách người dùng
        Route::get('/all-user', [UserController::class, 'all_user'])->name('user.all');
        Route::get('/add-user', [UserController::class, 'add_user'])->name('user.add');
        Route::post('/select-address-user', [UserController::class, 'select_address_user']);
        // Lưu đăng ký tham quan mới
        Route::post('/save-user', [UserController::class, 'save_user'])->name('user.save');
        // Xem chi tiết đơn đăng ký tham quan trung tâm
        Route::get('/edit-user/{id}', [UserController::class, 'edit_user'])->name('user.edit');
        Route::post('/update-user/{id}', [UserController::class, 'update_user'])->name('user.update');
        // Xoá đăng ký tham quan trung tâm
        Route::delete('/delete-user/{id}', [UserController::class, 'delete_user'])->name('user.delete');
        
        // === Duyệt đơn đăng ký đang chờ duyệt
        Route::get('/browse-user', [UserController::class, 'browse_user'])->name('browseuser.all');
        Route::get('/detail-browse-user/{id}', [UserController::class, 'detail_browse_user'])->name('browseuser.detail');
        // Duyệt
        Route::get('/save-browse-user/{id}', [UserController::class, 'save_browse_user'])->name('browseuser.save');
    });

    // ---------------------Quản lý người cao tuổi--------------------------
    Route::prefix('nguoicaotuoi')->group(function(){
        // === Quản lý danh sách người dùng
        Route::get('/all-elderly', [HoSoNguoiCaoTuoiController::class, 'all_elderly'])->name('elderly.all');
        Route::get('/add-elderly', [HoSoNguoiCaoTuoiController::class, 'add_elderly'])->name('elderly.add');
        // Lưu đăng ký tham quan mới
        Route::post('/save-elderly', [HoSoNguoiCaoTuoiController::class, 'save_elderly'])->name('elderly.save');
        // Xem chi tiết đơn đăng ký tham quan trung tâm
        Route::get('/edit-elderly/{id}', [HoSoNguoiCaoTuoiController::class, 'edit_elderly'])->name('elderly.edit');
        Route::post('/update-elderly/{id}', [HoSoNguoiCaoTuoiController::class, 'update_elderly'])->name('elderly.update');
        // Xoá đăng ký tham quan trung tâm
        Route::delete('/delete-elderly/{id}', [HoSoNguoiCaoTuoiController::class, 'delete_elderly'])->name('elderly.delete');
        
        // === Duyệt đơn đăng ký đang chờ duyệt
        Route::get('/browse-elderly', [HoSoNguoiCaoTuoiController::class, 'browse_elderly'])->name('browseelderly.all');
        Route::get('/detail-browse-elderly/{id}', [HoSoNguoiCaoTuoiController::class, 'detail_browse_elderly'])->name('browseelderly.detail');
        // Duyệt
        Route::get('/save-browse-elderly/{id}', [HoSoNguoiCaoTuoiController::class, 'save_browse_elderly'])->name('browseelderly.save');
    });
});
