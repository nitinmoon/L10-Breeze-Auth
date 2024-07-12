<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::prefix('admin')->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/logout', [DashboardController::class, 'logout'])->name('admin.logout');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
        Route::patch('/profile-image-update', [ProfileController::class, 'profileImageUpdate'])->name('profile.update.image');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('/change-password-form', [ProfileController::class, 'changePasswordForm'])->name('admin.change.password');
        Route::put('/update-password', [ProfileController::class, 'updatePassword'])->name('admin.password.update');


        Route::get('/product-import-job', [ProductController::class, 'index'])->name('product.productImportJob');
        Route::post('/product-store-job', [ProductController::class, 'storeBulk'])->name('product.storeBulk');
        Route::get('/send-product-job-queue', [ProductController::class, 'sendProductJobQueue'])->name('product.sendProductJobQueue');
    });
       
});

require __DIR__.'/auth.php';
