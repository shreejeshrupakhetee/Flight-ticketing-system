<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\TravelNameController;
use App\Http\Controllers\FlightTypeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
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


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/traveldetails/{travel}',[TravelController::class,'traveldetails'])->name('travel.details');
Route::get('/search',[UserController::class,'search'])->name('search');
Route::get('/allticket',[UserController::class,'allticket'])->name('alltickets');
Auth::routes(['verify' => true]);

Route::middleware(['auth','verified','IsUser'])->group(function(){
    Route::get('/userprofile',[UserController::class,'index'])->name('userprofile');
    Route::post('updateprofile',[UserController::class,'updateprofile'])->name('updateprofile');
    Route::post('book',[BookingController::class,'store'])->name('book');
    Route::get('checkout',[BookingController::class,'checkout'])->name('checkoutview');
    Route::delete('bookingdestroy/{book}',[UserController::class,'destroy'])->name('booking.destroy');
    Route::get('userticketdetails/{view}',[UserController::class,'userview'])->name('userview');
    Route::put('updateBooking',[BookingController::class,'update'])->name('booking.update');
   
});
Route::middleware(['auth','verified','IsAdmin'])->group(function () {
    Route::get('/adminprofile',[HomeController::class,'adminprofile'])->name('adminprofile');
    Route::get('/admindashboard',[HomeController::class,'adminbashboard'])->name('admindashboard');
    Route::resource('travel',TravelController::class);
    Route::resource('travelname',TravelNameController::class);
    Route::resource('traveltype',FlightTypeController::class);
    //admin user crud
    Route::get('/adminuser',[UserController::class,'AdminUser'])->name('adminUser');
    Route::get('/edituser/{slug}',[UserController::class,'editUser'])->name('user.edit');
    Route::put('/updateuser',[UserController::class,'updateUseremail'])->name('user.update');
    Route::delete('/destroyuser/{slug}',[UserController::class,'deleteUser'])->name('user.destroy');
    //booking
    Route::get('/bookedTicket',[BookingController::class,'index'])->name('booked.index');
    Route::delete('/deleteTicket/{slug}',[BookingController::class,'destroy'])->name('booked.destroy');
});








