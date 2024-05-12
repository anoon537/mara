<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhotoPackageController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
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


// RuteLanding Page
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/photo-package', [HomeController::class, 'showPhotoPackages'])->name('produk');
Route::get('/photo-package/{id}', [PhotoPackageController::class, 'show'])->name('home.detail');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/galery', [HomeController::class, 'showGalery'])->name('galery');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/terms-conditions', [HomeController::class, 'terms'])->name('terms-conditions');
Route::get('/how-to-shop', [HomeController::class, 'howShop'])->name('howShop');


//////////////// Profile Route ///////////////////
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//////////////// Admin Route ///////////////////

Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'admindashboard'])->name('admin.index');

    // Rute User Settings
    Route::get('/users', [AdminController::class, 'indexUsers'])->name('admin.users.user-settings');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');

    // Rute Photo Package
    Route::get('/photo-packages', [PhotoPackageController::class, 'index'])->name('photo_packages.index');
    Route::get('/photo-packages/create', [PhotoPackageController::class, 'create'])->name('photo_packages.create');
    Route::post('/photo-packages', [PhotoPackageController::class, 'store'])->name('photo_packages.store');
    Route::get('/photo-packages/{id}/edit', [PhotoPackageController::class, 'edit'])->name('photo_packages.edit');
    Route::put('/photo-packages/{id}', [PhotoPackageController::class, 'update'])->name('photo_packages.update');
    Route::delete('/photo-packages/{id}', [PhotoPackageController::class, 'destroy'])->name('photo_packages.destroy');

    // Rute galeri
    Route::get('/galerys', [GaleryController::class, 'index'])->name('admin.galery');
    Route::get('/galerys/create', [GaleryController::class, 'create'])->name('admin.galery.create');
    Route::post('/galerys', [GaleryController::class, 'store'])->name('admin.galery.store');
    Route::get('/galery/{id}/edit', [GaleryController::class, 'edit'])->name('admin.galery.edit');
    Route::put('/galery/{id}', [GaleryController::class, 'update'])->name('admin.galery.update');
    Route::delete('/galery/{id}', [GaleryController::class, 'destroy'])->name('admin.galery.destroy');

    // Rute bookings
    Route::get('/bookings', [AdminController::class, 'indexBookings'])->name('admin.bookings.index');
    Route::get('/bookings/{id}', [AdminController::class, 'showBookings'])->name('admin.bookings.show');
    Route::post('/bookings/approve/{id}', [AdminController::class, 'approve'])->name('admin.payments.approve');
    Route::post('/bookings/mark-pending/{id}', [AdminController::class, 'markPending'])->name('admin.payments.markPending');
    Route::post('/bookings/complete/{id}', [AdminController::class, 'complete'])->name('admin.bookings.complete');
    Route::get('/bookings/invoice/{id}', [AdminController::class, 'printInvoice'])->name('admin.bookings.printInvoice');
    Route::delete('/bookings/{id}', [AdminController::class, 'destroyBooking'])->name('admin.bookings.destroy');


    // Rute laporan
    Route::get('/reports', [AdminController::class, 'indexReport'])->name('admin.reports.index');
    Route::get('/reports/generate', [AdminController::class, 'generateReport'])->name('admin.reports.generate');
    Route::get('/reports/generate-pdf', [AdminController::class, 'generatePdfReport'])->name('admin.reports.generate-pdf');

    // Rute Direct Order 
    Route::get('/direct-order', [AdminController::class, 'indexDO'])->name('admin.do.index');
    Route::get('/direct-order/create', [AdminController::class, 'createDO'])->name('admin.do.create');
    Route::post('/direct-order', [AdminController::class, 'storeDO'])->name('admin.do.store');
    Route::delete('/direct-order/{id}', [AdminController::class, 'destroyDO'])->name('admin.do.destroy');
});

//////////////// User Route ///////////////////

Route::middleware(['auth', 'roles:user', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('homepage');
    Route::get('/booking/{package_id}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/confirmation/{booking_id}', [BookingController::class, 'confirmation'])->name('booking.confirmation');

    Route::get('/payment/create/{booking_id}', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment/store', [PaymentController::class, 'store'])->name('payment.store');
    Route::get('/success', function () {
        return view('home.booking.success');
    })->name('booking.success');
    Route::get('/payment-history', [PaymentController::class, 'history'])->name('payment.history');
});

require __DIR__ . '/auth.php';
