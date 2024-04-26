<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GuestController as AdminGuestController;
use App\Http\Controllers\Admin\RoomTypeController as AdminRoomTypeController;
use App\Http\Controllers\Admin\ActivityController as AdminActivityController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GuestController;
use App\Http\Middleware\CheckLoginAdmin;
use App\Http\Middleware\CheckAdminAlreadyLogin;
use App\Http\Middleware\CheckAdminLevel;
use App\Http\Middleware\CheckLoginGuest;
use App\Http\Middleware\CheckGuestAlreadyLogin;
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

//GUEST---------------------------------------------------------
//HOME
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('guest.home');
    Route::get('/home', 'index')->name('guest.home');
    Route::get('/contact', 'contact')->name('guest.contact');
    Route::get('/about', 'about')->name('guest.about');
});

//ROOMS
Route::prefix('/rooms')->controller(RoomController::class)->group(function () {
    Route::get('/', 'index')->name('guest.rooms');
    Route::post('/', 'index')->name('guest.rooms.search');
    Route::get('/{room}', 'show')->name('guest.rooms.show');
});

//BOOKING
Route::prefix('/booking')->controller(BookingController::class)->group(function () {
    Route::post('/', 'bookRoom')->name('guest.bookRoom');
//    CHECKOUT
    Route::prefix('/checkout')->group(function () {
        Route::get('/', 'checkOut')->name('guest.checkOut');
        Route::get('/payInPerson', 'payInPerson')->name('guest.checkOut.payInPerson');
        Route::get('/banking', 'banking')->name('guest.checkOut.banking');
        Route::get('/success', 'success')->name('guest.checkOut.success');
    });
});

//END ROOMS

//LOGIN REGISTER LOGOUT
Route::middleware([CheckGuestAlreadyLogin::class])->controller(GuestController::class)->group(function () {
    Route::get('/login', 'login')->name('guest.login');
    Route::post('/login', 'loginProcess')->name('guest.loginProcess');
    Route::get('/signup', 'register')->name('guest.register');
    Route::post('/signup', 'registerProcess')->name('guest.registerProcess');
});
Route::get('/logout', [GuestController::class, 'logout'])->name('guest.logout');
//LOGIN REGISTER LOGOUT

//PROFILE
Route::middleware([CheckLoginGuest::class])->controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'profile')->name('guest.profile');
    Route::get('/editAccount', 'editAccount')->name('guest.editAccount');
    Route::put('/editAccount', 'updateAccount')->name('guest.updateAccount');
    Route::get('/changePassword', 'changePassword')->name('guest.changePassword');
    Route::prefix('/myBooking')->group(function () {
        Route::get('/', 'myBooking')->name('guest.myBooking');
        Route::get('/{booking}', 'bookingDetail')->name('guest.bookingDetail');
        Route::post('/{booking}/cancel', 'cancelBooking')->name('guest.cancelBooking');
    });
    Route::post('/deleteAccount', 'deleteAccount')->name('guest.deleteAccount');
});
//PROFILE

//GUEST---------------------------------------------------------


//ADMIN---------------------------------------------------------
Route::prefix('admin')->group(function () {
    Route::middleware([CheckLoginAdmin::class])->group(function () {
        Route::middleware([CheckAdminLevel::class])->group(function () {
            //    DASHBOARD =====================================================================================
            Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
            Route::prefix('dashboard')->group(function () {
                Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
            });

            // ACTIVITIES =====================================================================================
            Route::get('/activities', [AdminActivityController::class, 'index'])->name('admin.activities');
            Route::get('/activities/downloadPdf', [AdminActivityController::class, 'downloadPDF'])->name('admin.activities.downloadPdf');

            // ROOM TYPES =====================================================================================
            Route::prefix('roomTypes')->controller(AdminRoomTypeController::class)->group(function () {
                Route::get('/', 'index')->name('admin.roomTypes');
                Route::get('/create', 'create')->name('admin.roomTypes.create');
                Route::post('/create', 'store')->name('admin.roomTypes.store');
                Route::get('/{roomType}/edit', 'edit')->name('admin.roomTypes.edit');
                Route::put('/{roomType}/edit', 'update')->name('admin.roomTypes.update');
                Route::delete('/delete', 'destroy')->name('admin.roomTypes.destroy');
                // PDF
                Route::get('downloadPdf', 'downloadPDF')->name('admin.roomTypes.downloadPdf');
            });

            // ROOMS =====================================================================================
            Route::prefix('rooms')->group(function () {
                Route::get('/', [AdminRoomController::class, 'index'])->name('admin.rooms');
                Route::get('/create', [AdminRoomController::class, 'create'])->name('admin.rooms.create');
                Route::post('/create', [AdminRoomController::class, 'store'])->name('admin.rooms.store');
                Route::get('/{room}/edit', [AdminRoomController::class, 'edit'])->name('admin.rooms.edit');
                Route::put('/{room}/edit', [AdminRoomController::class, 'update'])->name('admin.rooms.update');
                Route::get('/{room}/edit/destroyImage', [AdminRoomController::class, 'destroyImage'])->name('admin.rooms.update.destroyImage');
                Route::get('/{room}/edit/destroyAllImages', [AdminRoomController::class, 'destroyAllImages'])->name('admin.rooms.update.destroyAllImages');
                Route::delete('/delete', [AdminRoomController::class, 'destroy'])->name('admin.rooms.destroy');
                // PDF
                Route::get('downloadPdf', [AdminRoomController::class, 'downloadPDF'])->name('admin.rooms.downloadPdf');
            });

            // EMPLOYEES =====================================================================================
//        Route::prefix('employees')->group(function () {
//            Route::get('/', [AdminEmployeeController::class, 'index'])->name('admin.employees');
//            Route::get('/create', [AdminEmployeeController::class, 'create'])->name('admin.employees.create');
//            Route::post('/create', [AdminEmployeeController::class, 'store'])->name('admin.employees.store');
//            Route::get('/{employee}/edit', [AdminEmployeeController::class, 'edit'])->name('admin.employees.edit');
//            Route::put('/{employee}/edit', [AdminEmployeeController::class, 'update'])->name('admin.employees.update');
//            Route::delete('/delete', [AdminEmployeeController::class, 'destroy'])->name('admin.employees.destroy');
//            // PDF
//            Route::get('downloadPdf', [AdminEmployeeController::class, 'downloadPDF'])->name('admin.employees.downloadPdf');
//        });

            // ADMINISTRATORS =====================================================================================
            Route::prefix('admins')->group(function () {
                Route::get('/', [AdminController::class, 'index'])->name('admin.admins');
                Route::get('/create', [AdminController::class, 'create'])->name('admin.admins.create');
                Route::post('/create', [AdminController::class, 'store'])->name('admin.admins.store');
                Route::get('/{admin}/edit', [AdminController::class, 'edit'])->name('admin.admins.edit');
                Route::put('/{admin}/edit', [AdminController::class, 'update'])->name('admin.admins.update');
                Route::delete('/delete', [AdminController::class, 'destroy'])->name('admin.admins.destroy');
                // PDF
                Route::get('downloadPdf', [AdminController::class, 'downloadPDF'])->name('admin.admins.downloadPdf');
            });

            // RATINGS
            Route::prefix('ratings')->group(function () {
                Route::get('/', [AdminController::class, 'ratings'])->name('admin.ratings');
            });
        });

        // BOOKINGs
        Route::prefix('bookings')->group(function () {
            Route::get('/', [AdminBookingController::class, 'index'])->name('admin.bookings');
            Route::get('/create', [AdminBookingController::class, 'create'])->name('admin.bookings.create');
            Route::post('/create', [AdminBookingController::class, 'store'])->name('admin.bookings.store');
            Route::get('/{booking}/edit', [AdminBookingController::class, 'edit'])->name('admin.bookings.edit');
            Route::put('/{booking}/edit', [AdminBookingController::class, 'update'])->name('admin.bookings.update');
            Route::delete('/delete', [AdminBookingController::class, 'destroy'])->name('admin.bookings.destroy');
            // PDF
            Route::get('downloadPdf', [AdminBookingController::class, 'downloadPDF'])->name('admin.bookings.downloadPdf');
        });

        // PAYMENTS
        Route::prefix('payments')->group(function () {
            Route::get('/', [AdminController::class, 'bookings'])->name('admin.payments');
        });

        // GUESTS =====================================================================================
        Route::prefix('guests')->group(function () {
            Route::get('/', [AdminGuestController::class, 'index'])->name('admin.guests');
            Route::get('/create', [AdminGuestController::class, 'create'])->name('admin.guests.create');
            Route::post('/create', [AdminGuestController::class, 'store'])->name('admin.guests.store');
            Route::get('/{guest}/edit', [AdminGuestController::class, 'edit'])->name('admin.guests.edit');
            Route::put('/{guest}/edit', [AdminGuestController::class, 'update'])->name('admin.guests.update');
            Route::delete('/delete', [AdminGuestController::class, 'destroy'])->name('admin.guests.destroy');
            // PDF
            Route::get('downloadPdf', [AdminGuestController::class, 'downloadPDF'])->name('admin.guests.downloadPdf');
        });

        // SETTINGS
        Route::prefix('settings')->group(function () {
            Route::get('/', [AdminController::class, 'settings'])->name('admin.settings');
        });
    });

    //    LOGIN
    Route::middleware(CheckAdminAlreadyLogin::class)->controller(AdminController::class)->group(function () {
        Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
        Route::post('/login', [AdminController::class, 'loginProcess'])->name('admin.loginProcess');
    });

    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});
//ADMIN---------------------------------------------------------
