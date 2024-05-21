<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GuestController as AdminGuestController;
use App\Http\Controllers\Admin\RoomTypeController as AdminRoomTypeController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\RoomTypeController;
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
    Route::post('/contact', 'sendContact')->name('guest.sendContact');
    Route::get('/about', 'about')->name('guest.about');
});

//ROOMS
Route::prefix('/rooms')->controller(RoomTypeController::class)->group(function () {
    Route::get('/', 'index')->name('guest.rooms');
    Route::post('/', 'index')->name('guest.rooms.search');
    Route::get('/{room}', 'show')->name('guest.rooms.show');
});

Route::prefix('/cart')->controller(CartController::class)->group(function () {
    Route::get('/', 'cart')->name('guest.cart');
    Route::post('/addToCart', 'addToCart')->name('guest.cart.addToCart');
    Route::post('/update', 'updateQuantity')->name('guest.cart.updateQuantity');
    Route::get('/delete/{id}', 'deleteFromCart')->name('guest.cart.delete');
    Route::get('/deleteAll', 'deleteAllFromCart')->name('guest.cart.deleteAll');
});
//PAYMENT ===================
Route::prefix('/payment')->controller(PaymentController::class)->group(function () {
    Route::get('', 'payment')->name('guest.payment');
    Route::post('', 'paymentProcess')->name('guest.paymentProcess');
    Route::get('/redirect', 'paymentRedirect')->name('guest.paymentRedirect');
    Route::post('/vnpay', 'vnpay_payment')->name('guest.vnpay');
    Route::get('/success', 'paymentSuccess')->name('guest.paymentSuccess');
});

//BOOKING
Route::get('/booking', [BookingController::class, 'booking'])->name('guest.booking');
//END ROOMS

//LOGIN REGISTER LOGOUT
Route::middleware([CheckGuestAlreadyLogin::class])->controller(GuestController::class)->group(function () {
    Route::get('/login', 'login')->name('guest.login');
    Route::post('/login', 'loginProcess')->name('guest.loginProcess');
    Route::get('/signup', 'register')->name('guest.register');
    Route::post('/signup', 'registerProcess')->name('guest.registerProcess');
    Route::get('/forgotPassword', 'forgotPassword')->name('guest.forgotPassword');
    Route::post('/forgotPassword', 'forgotPasswordSendEmail')->name('guest.forgotPassword.sendEmail');
    Route::get('/forgotPassword/enterCode', 'forgotPasswordEnterCode')->name('guest.forgotPassword.enterCode');
    Route::post('/forgotPassword/enterCode', 'forgotPasswordCheckCode')->name('guest.forgotPassword.checkCode');
    Route::get('/resetPassword', 'resetPassword')->name('guest.forgotPassword.resetPassword');
    Route::put('/resetPassword', 'resetPasswordProcess')->name('guest.forgotPassword.resetPasswordProcess');
});
Route::get('/logout', [GuestController::class, 'logout'])->name('guest.logout');
//LOGIN REGISTER LOGOUT

//PROFILE
Route::middleware([CheckLoginGuest::class])->controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'profile')->name('guest.profile');
    Route::put('/profile', 'updateAccount')->name('guest.updateAccount');
    Route::get('/changePassword', 'changePassword')->name('guest.changePassword');
    Route::put('/changePassword', 'updatePassword')->name('guest.updatePassword');
    Route::prefix('/myBooking')->group(function () {
        Route::get('/', 'myBooking')->name('guest.myBooking');
        Route::get('/{booking}', 'bookingDetail')->name('guest.bookingDetail');
        Route::post('/{booking}/cancel', 'cancelBooking')->name('guest.cancelBooking');
        Route::post('/{booking}/rate', [RateController::class, 'rateBooking'])->name('guest.rateBooking');
        Route::delete('/{booking}/deleteRate', [RateController::class, 'deleteRate'])->name('guest.deleteRate');
    });
    Route::post('/deleteAccount', 'deleteAccount')->name('guest.deleteAccount');
});
//PROFILE

//GUEST---------------------------------------------------------
//=======================================================================================================================================================
//ADMIN---------------------------------------------------------
Route::prefix('admin')->group(function () {
    //Check login
    Route::middleware([CheckLoginAdmin::class])->group(function () {
        //Check level (level 0 - system admin)
        Route::middleware([CheckAdminLevel::class])->group(function () {
            //    DASHBOARD =====================================================================================
            Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
            Route::prefix('/dashboard')->controller(DashboardController::class)->group(function () {
                Route::get('/', 'index')->name('admin.dashboard');
                Route::get('/fast-confirm/{booking}', 'fastConfirm')->name('admin.dashboard.fastConfirm');
            });

            // ACTIVITIES =====================================================================================
            Route::controller(ActivityController::class)->group(function () {
                Route::get('/activities', 'index')->name('admin.activities');
                Route::post('/activities', 'clear')->name('admin.activities.clear');
            });

            // ROOM TYPES =====================================================================================
            Route::prefix('roomTypes')->controller(AdminRoomTypeController::class)->group(function () {
                Route::get('/', 'index')->name('admin.roomTypes');
                Route::get('/create', 'create')->name('admin.roomTypes.create');
                Route::post('/create', 'store')->name('admin.roomTypes.store');
                Route::get('/{roomType}/edit', 'edit')->name('admin.roomTypes.edit');
                Route::put('/{roomType}/edit', 'update')->name('admin.roomTypes.update');
                Route::get('/{roomType}/edit/destroyImage', 'destroyImage')->name('admin.roomTypes.destroyImage');
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

            // AMENITIES =====================================================================================
            Route::prefix('/amenities')->controller(AmenityController::class)->group(function () {
                Route::get('/', 'index')->name('admin.amenities');
                Route::get('/create', 'create')->name('admin.amenities.create');
                Route::post('/create', 'store')->name('admin.amenities.store');
                Route::get('/{amenity}/edit', 'edit')->name('admin.amenities.edit');
                Route::put('/{amenity}/edit', 'update')->name('admin.amenities.update');
                Route::delete('/destroy', 'destroy')->name('admin.amenities.destroy');
            });

            // SERVICES =====================================================================================
            Route::prefix('/services')->controller(ServiceController::class)->group(function () {
                Route::get('/', 'index')->name('admin.services');
                Route::get('/create', 'create')->name('admin.services.create');
                Route::post('/create', 'store')->name('admin.services.store');
                Route::get('/{service}/edit', 'edit')->name('admin.services.edit');
                Route::put('/{service}/edit', 'update')->name('admin.services.update');
                Route::delete('/destroy', 'destroy')->name('admin.services.destroy');
            });

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
        Route::prefix('bookings')->controller(AdminBookingController::class)->group(function () {
            Route::get('/', 'index')->name('admin.bookings');
            Route::get('/{booking}', 'show')->name('admin.bookings.show');
            Route::get('/create', 'create')->name('admin.bookings.create');
            Route::post('/create', 'storeDate')->name('admin.bookings.storeDate');
            Route::get('/create/choose_room', 'createChooseRoom')->name('admin.bookings.createChooseRoom');
            Route::post('/create/choose_room', 'storeRoom')->name('admin.bookings.storeRoom');
            Route::get('/create/choose_guest', 'createChooseGuest')->name('admin.bookings.createChooseGuest');
            Route::post('/create/choose_guest', 'storeGuest')->name('admin.bookings.storeGuest');
            Route::get('/{booking}/edit', 'edit')->name('admin.bookings.edit');
            Route::put('/{booking}/edit', 'update')->name('admin.bookings.update');
//            Route::delete('/delete', 'destroy')->name('admin.bookings.destroy');
            //room arrangement
            Route::get('/room_arrangement', 'roomArrangement')->name('admin.bookings.roomArrangement');

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

        //STATISTIC =====================================================================================
        Route::prefix('statistics')->controller(StatisticController::class)->group(function () {
            Route::get('/revenue', 'revenueReport')->name('admin.statistics.revenue');
            Route::get('/rooms', 'roomReport')->name('admin.statistics.rooms');
            Route::get('/services', 'serviceReport')->name('admin.statistics.services');
            Route::get('/foods', 'foodReport')->name('admin.statistics.foods');
            Route::get('/guests', 'guestReport')->name('admin.statistics.guests');
        });

        // SETTINGS
        Route::prefix('settings')->group(function () {
            Route::get('/', [SettingController::class, 'setting'])->name('admin.settings');
            Route::post('/{admin}', [SettingController::class, 'saveSetting'])->name('admin.saveSetting');
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

