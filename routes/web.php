<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminRouteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\SceduleController;
use App\Http\Middleware\AdminProtected;
use App\Http\Middleware\AuthProtected;
use App\Http\Middleware\GuestProtected;
use Illuminate\Support\Facades\Route;

Route::get('/',[RouteController::class,'index']);
Route::get('/about',[InfoController::class,'aboutPage']);
Route::get('/faq',[InfoController::class,'faq']);
Route::get('/search',[RouteController::class,'search']);
Route::get('/seats/{id}',[BusController::class,'seats']);
Route::post('/reserve-seat',[BookingController::class,'bookSeatOnline']);
Route::post('/payment',[PaymentController::class,'payment'])->name('payment');
Route::post('/payment/success',[PaymentController::class,'success'])->name('payment.success');
Route::post('/payment/fail',[PaymentController::class,'fail'])->name('payment.fail');

Route::middleware(GuestProtected::class)->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login',[AuthController::class,'login']);
    Route::get('/register',function(){
        return view('auth.register');
    })->name('register');
    Route::post('/register',[AuthController::class,'register'])->name('register');
    Route::get('/verify-email',[AuthController::class,'showVerifyEmail'])->name('verifyEmail');
    Route::post('/verify-email',[AuthController::class,'verifyEmail']);
    Route::get('/forgot-password',function(){
        return view('auth.forgotPassword');
    })->name('forgetPassword');
    Route::get('/password-reset/{token}',[AuthController::class,'showResetPasswordForm']);
    Route::post('/password-reset/{token}',[AuthController::class,'resetPassword']);
    Route::post('/ajax/forgot-password',[AuthController::class,'sendForgotPassword']);
    Route::post('/ajax/verify-forgot-password',[AuthController::class,'verifyForgotPassword']);
});

Route::middleware(AuthProtected::class)->group(function () {
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    Route::get('/profile',function(){
        return view('auth.profile');
    })->name('profile');
    Route::get('/bookings',[BookingController::class,'all'])->name('booking');
    Route::post('/update-profile',[AuthController::class,'updateProfile'])->name('update-profile');
    Route::get('/booking/{pnr}',[BookingController::class,'singleBooking'])->name('singleBooking');
});

Route::prefix('admin')->group(function (){
    Route::get('/login',[AdminRouteController::class,'login']);
    Route::post('/login',[AdminAuthController::class,'login']);
    Route::get('/',[AdminAuthController::class,'index']);
    Route::middleware(AdminProtected::class)->group(function(){
        Route::post('/ajax/reserve',[BookingController::class,'bookSeatfromCounterVerifyOTP']);
        Route::post('/ajax/reserve-verify',[BookingController::class,'bookSeatfromCounter']);
        Route::get('/logout',[AdminAuthController::class,'logout'])->name('admin.logout');
        Route::get('/dashboard',[AdminRouteController::class,'dashboard'])->name('admin.dashboard');
        Route::get('/profile',function (){
            return view('admin.pages.profile');
        })->name('admin.profile');
        Route::post('/profile',[AdminAuthController::class,'updateProfile'])->name('admin.profile.update');
        Route::get('/change-password',function(){
            return view('admin.pages.changePassword');
        })->name('admin.profile.password.change');
        Route::post('/change-password',[AdminAuthController::class,'updatePassword'])->name('admin.profile.password.update');
        Route::get('/bus',[BusController::class,'index'])->name('admin.bus');
        Route::get('/bus/add',function(){
            return view('admin.pages.add-bus');
        })->name('admin.bus.add');
        Route::post('/bus/add',[BusController::class,'add']);
        Route::get('/bus/view/{id}',[BusController::class,'view'])->name('admin.bus.view');
        Route::delete('/bus/delete/{id}',[BusController::class,'delete'])->name('admin.bus.delete');
        Route::get('/point',[PointController::class,'index'])->name('admin.point');
        Route::get('/point/add',function(){
            return view('admin.pages.add-point');
        })->name('admin.point.add');
        Route::post('/point/add',[PointController::class,'add'])->name('admin.point.add');
        Route::delete('/point/delete/{id}',[PointController::class,'delete'])->name('admin.point.delete');
        Route::get('/scedule',[SceduleController::class,'index'])->name('admin.scedule');
        Route::get('/scedule/add',[SceduleController::class,'addIndex'])->name('admin.scedule.add');
        Route::post('/scedule/add',[SceduleController::class,'add']);
        Route::delete('/scedule/delete/{id}',[SceduleController::class,'delete'])->name('admin.scedule.delete');
        Route::get('/booking',function (){
            return view('admin.pages.all-bookings');
        })->name('admin.booking');
        Route::get('/booking/add',[BookingController::class,'index'])->name('admin.booking.add');
        Route::get('/book/{id}/{doj}',[BookingController::class,'bookingIndex'])->name('admin.book.add');
        Route::get('/booking/search',[BookingController::class,'searchByPNR']);
        Route::get('/info/about',[InfoController::class,"aboutIndex"])->name('info.about');
        Route::post('/info/about',[InfoController::class,"aboutUpd"]);
        Route::get('/info/faq',[FaqController::class,'adminIndex'])->name('info.faq');
        Route::post('faq/create',[FaqController::class,'create']);
        Route::post('faq/edit',[FaqController::class,'edit']);
        Route::post('faq/delete',[FaqController::class,'delete']);
    });
});
