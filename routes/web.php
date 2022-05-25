<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoSoVatChatController;
use App\Http\Controllers\DangKyThamQuanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HoSoNguoiCaoTuoiController;
use App\Http\Controllers\NhaCungCapController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\ThongBaoController;
use App\Http\Controllers\UserController;
use App\Models\HoSoNguoiCaoTuoi;

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
    // Cập nhật thông tin cá nhân
    Route::get('/admin-profile/{id}', [AdminController::class, 'admin_profile'])->name('admin.profile');
    Route::post('/update-admin-profile/{id}', [AdminController::class, 'update_admin_profile'])->name('admin.profile.update');

    // ================ Quản lý trung tâm ===========================
    Route::prefix('quanly')->group(function(){
        // ---------------Quản lí thông báo---------------
        Route::prefix('notification')->group(function(){
            Route::get('/all-notification', [ThongBaoController::class, 'all_notification'])->name('notification.all');
            Route::get('all-notification/fetch_data', [ThongBaoController::class, 'fetch_data']);
            Route::get('/add-notification', [ThongBaoController::class, 'add_notification'])->name('notification.add');
            // Lưu thông báo mới
            Route::post('/save-notification', [ThongBaoController::class, 'save_notification'])->name('save_notification');
            // Chỉnh sửa thông báo
            Route::get('/edit-notification/{id}', [ThongBaoController::class, 'edit_notification'])->name('notification.edit');
            Route::post('/update-notification/{id}', [ThongBaoController::class, 'update_notification'])->name('notification.update');
            // Xoá thông báo
            Route::delete('/delete-notification/{id}', [ThongBaoController::class, 'delete_notification'])->name('notification.delete');
        });
        // ----------------- Quản lý Đăng ký tham quan trung tâm----------------
        Route::prefix('register-to-visit')->group(function(){
            // === Quản lý danh sách đơn đăng ký
            Route::get('/all-registerToVisit', [DangKyThamQuanController::class, 'all_registerToVisit'])->name('registerToVisit.all');
            Route::get('/add-registerToVisit', [DangKyThamQuanController::class, 'add_registerToVisit'])->name('registerToVisit.add');
            // Lưu đăng ký tham quan mới
            Route::post('/save-registerToVisit', [DangKyThamQuanController::class, 'save_registerToVisit'])->name('registerToVisit.save');
            // Xem chi tiết đơn đăng ký tham quan trung tâm
            Route::get('/detail-registerToVisit/{id}', [DangKyThamQuanController::class, 'detail_registerToVisit'])->name('registerToVisit.detail');
            Route::post('/update-registerToVisit/{id}', [DangKyThamQuanController::class, 'update_registerToVisit'])->name('registerToVisit.update');
            // Xoá đăng ký tham quan trung tâm
            Route::delete('/delete-registerToVisit/{id}', [DangKyThamQuanController::class, 'delete_registerToVisit'])->name('registerToVisit.delete');
            
            // === Duyệt đơn đăng ký đang chờ duyệt
            Route::get('/browse-application', [DangKyThamQuanController::class, 'browse_application'])->name('browseapplication.all');
            Route::get('/detail-browse-application/{id}', [DangKyThamQuanController::class, 'detail_browse_application'])->name('browseapplication.detail');
            Route::get('/save-browse-application/{id}', [DangKyThamQuanController::class, 'save_browse_application'])->name('browseapplication.save');

            // === Thùng rác
            Route::get('/garbagecan-application', [DangKyThamQuanController::class, 'garbagecan_application'])->name('garbagecanapplication.all');
            // === Đơn tham quan hôm nay theo lịch
            Route::get('/all-application-today', [DangKyThamQuanController::class, 'all_today_application'])->name('allapplicationtoday.all');
        });
        
        // ---------------------Quản lý người dùng--------------------------
        Route::prefix('user')->group(function(){
            // === Quản lý danh sách người dùng
            Route::get('/all-user', [UserController::class, 'all_user'])->name('user.all');
            Route::get('/add-user', [UserController::class, 'add_user'])->name('user.add');
            Route::post('/select-address-user', [UserController::class, 'select_address_user']);
            // Lưu đăng ký mới
            Route::post('/save-user', [UserController::class, 'save_user'])->name('user.save');
            // Xem chi tiết đơn đăng ký 
            Route::get('/edit-user/{id}', [UserController::class, 'edit_user'])->name('user.edit');
            Route::post('/update-user/{id}', [UserController::class, 'update_user'])->name('user.update');
            // Xoá đăng ký 
            Route::delete('/delete-user/{id}', [UserController::class, 'delete_user'])->name('user.delete');
            // Khoá tài khoản
            Route::get('/unactive-user/{id}', [UserController::class, 'unactive_user'])->name('user.unactive');
            // Khởi động tài khoản
            Route::get('/active-user/{id}', [UserController::class, 'active_user'])->name('user.active');
            // === Duyệt đơn đăng ký đang chờ duyệt
            Route::get('/browse-user', [UserController::class, 'browse_user'])->name('browseuser.all');
            Route::get('/detail-browse-user/{id}', [UserController::class, 'detail_browse_user'])->name('browseuser.detail');
            // Duyệt
            Route::get('/save-browse-user/{id}', [UserController::class, 'save_browse_user'])->name('browseuser.save');
        });

        // ---------------------Quản lý người cao tuổi--------------------------
        Route::prefix('elderly')->group(function(){
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
            // Lưu trữ hồ sơ
            Route::get('/save-warehouse-elderly/{id}', [HoSoNguoiCaoTuoiController::class, 'save_warehouse_elderly'])->name('elderly.save.warehouse');
            
            // === Duyệt đơn đăng ký đang chờ duyệt
            Route::get('/browse-elderly', [HoSoNguoiCaoTuoiController::class, 'browse_elderly'])->name('browseelderly.all');
            Route::get('/detail-browse-elderly/{id}', [HoSoNguoiCaoTuoiController::class, 'detail_browse_elderly'])->name('browseelderly.detail');
            // Duyệt
            Route::get('/save-browse-elderly/{id}', [HoSoNguoiCaoTuoiController::class, 'save_browse_elderly'])->name('browseelderly.save');

            // === Kho dữ liệu
            // Mở kho hồ sơ
            Route::get('/warehouse-elderly', [HoSoNguoiCaoTuoiController::class, 'warehouse_elderly'])->name('elderly.warehouse');
            // Mở hoạt động của hồ sơ
            Route::get('/active-warehouse-elderly/{id}', [HoSoNguoiCaoTuoiController::class, 'active_warehouse_elderly'])->name('elderly.active.warehouse');
        });

        // -----------------Quản lý nhân viên-------------------------------
        Route::prefix('employee')->group(function(){
            // === Quản lý danh sách nhân viên
            Route::get('/all-employee', [NhanVienController::class, 'all_employee'])->name('employee.all');
            Route::get('/add-employee', [NhanVienController::class, 'add_employee'])->name('employee.add');
            // Lưu nhân viên mới
            Route::post('/save-employee', [NhanVienController::class, 'save_employee'])->name('employee.save');
            // Xem chi tiết nhân viên 
            Route::get('/edit-employee/{id}', [NhanVienController::class, 'edit_employee'])->name('employee.edit');
            Route::post('/update-employee/{id}', [NhanVienController::class, 'update_employee'])->name('employee.update');
            // Xoá tài khoản
            Route::delete('/delete-employee/{id}', [NhanVienController::class, 'delete_employee'])->name('employee.delete');
            // Khoá tài khoản
            Route::get('/unactive-employee/{id}', [NhanVienController::class, 'unactive_employee'])->name('employee.unactive');
            // Khởi động tài khoản
            Route::get('/active-employee/{id}', [NhanVienController::class, 'active_employee'])->name('employee.active');
            // Tìm kiếm với Ajax
            Route::post('/search-employee', [NhanVienController::class, 'search_employee'])->name('employee.search');
            
        });

        // ----------------- Quản lý nhà cung cấp ----------------------
        Route::prefix('supplier')->group(function(){
            // Danh sách 
            Route::get('/all-supplier', [NhaCungCapController::class, 'all_supplier'])->name('supplier.all');
            Route::get('/add-supplier', [NhaCungCapController::class, 'add_supplier'])->name('supplier.add');
            // Lưu nhà cung cấp mới
            Route::post('/save-supplier', [NhaCungCapController::class, 'save_supplier'])->name('supplier.save');
            // Xem chi tiết nhà cung cấp
            Route::get('/edit-supplier/{id}', [NhaCungCapController::class, 'edit_supplier'])->name('supplier.edit');
            Route::post('/update-supplier/{id}', [NhaCungCapController::class, 'update_supplier'])->name('supplier.update');
            // Xoá nhà cung cấp
            Route::delete('/delete-supplier/{id}', [NhaCungCapController::class, 'delete_supplier'])->name('supplier.delete');
            // Khoá nhà cung cấp
            Route::get('/unactive-supplier/{id}', [NhaCungCapController::class, 'unactive_supplier'])->name('supplier.unactive');
            // Khởi động nhà cung cấp
            Route::get('/active-supplier/{id}', [NhaCungCapController::class, 'active_supplier'])->name('supplier.active');
        });
    });

    // ====================== Nhân viên kho ==================================
    Route::prefix('nhanvienkho')->group(function(){
        
        // --------------- Quản lý cơ sở vật chất -------------------
        Route::prefix('infrastructure')->group(function(){
            // ----------- Danh sách cơ sở vật chất ---------------
            Route::get('/all-infrastructure', [CoSoVatChatController::class, 'all_infrastructure'])->name('infrastructure.all');
            Route::get('/add-infrastructure', [CoSoVatChatController::class, 'add_infrastructure'])->name('infrastructure.add');
            // Lưu cơ sở vật chất
            Route::post('/save-infrastructure', [CoSoVatChatController::class, 'save_infrastructure'])->name('infrastructure.save');
            // Xoá cơ sở vật chất
            Route::delete('/delete-infrastructure/{id}', [CoSoVatChatController::class, 'delete_infrastructure'])->name('infrastructure.delete');
            // Xem chi tiết cơ sở vật chất
            Route::get('/edit-infrastructure/{id}', [CoSoVatChatController::class, 'edit_infrastructure'])->name('infrastructure.edit');
            Route::post('/update-infrastructure/{id}', [CoSoVatChatController::class, 'update_infrastructure'])->name('infrastructure.update');
            // ----------- Kho lưu trữ -------------
            Route::get('/warehouse-infrastructure', [CoSoVatChatController::class, 'warehouse_infrastructure'])->name('warehouse.infrastructure.all');
            // Mở hoạt động của cơ sở vật chất
            Route::get('/active-warehouse-infrastructure/{id}', [CoSoVatChatController::class, 'active_warehouse_infrastructure'])->name('active.warehouse.infrastructure');
        });
    });


    // ===================== Nhân viên y tế =============================
    Route::prefix('nhanvienyte')->group(function(){
        
        // --------------- Cập nhật tình hình sức khoẻ người cao tuổi ---------------
        Route::prefix('health-situation')->group(function(){
            // --- Danh sách người cao tuổi -------
            Route::get('/all-health-elderly', [HoSoNguoiCaoTuoiController::class, 'all_health_elderly'])->name('health.elderly.all');
            // --- Chi tiết người cao tuổi ------
            Route::get('/detail-health-elderly/{id}', [HoSoNguoiCaoTuoiController::class, 'detail_health_elderly'])->name('health.elderly.detail');
            // --- Thêm tình hình sức khoẻ -------
            Route::post('/save-health-elderly/{id}', [HoSoNguoiCaoTuoiController::class, 'save_health_elderly'])->name('health.elderly.save');
            // --- Chỉnh sửa tình hình sức khoẻ người cao tuổi ------
            Route::get('/edit-health-elderly/{id}', [HoSoNguoiCaoTuoiController::class, 'edit_health_elderly'])->name('health.elderly.edit');
            // --- Lưu thông tin tình hình sức khoẻ được chinh sửa --------
            Route::post('/update-health-elderly/{id}', [HoSoNguoiCaoTuoiController::class, 'update_health_elderly'])->name('health.elderly.update');
            // --- Xoá tình hình sức khoẻ cho người cao tuổi được chọn ---------
            Route::delete('/delete-health-elderly/{id}', [HoSoNguoiCaoTuoiController::class, 'delete_health_elderly'])->name('health.elderly.delete');
        });


    });
});
