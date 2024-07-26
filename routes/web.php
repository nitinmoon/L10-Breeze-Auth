<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleDriveController;
use App\Http\Controllers\PhonePeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QrCodeController;
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

Route::prefix('admin')->group(function() {
Route::middleware(['auth', 'verified'])->group(function () {

    

        #Dashboard & Profile
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/logout', [DashboardController::class, 'logout'])->name('admin.logout');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile-update', [ProfileController::class, 'update'])->name('profile.update');
        Route::patch('/profile-image-update', [ProfileController::class, 'profileImageUpdate'])->name('profile.update.image');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('/change-password-form', [ProfileController::class, 'changePasswordForm'])->name('admin.change.password');
        Route::put('/update-password', [ProfileController::class, 'updatePassword'])->name('admin.password.update');

        #Queue-Job
        Route::get('/product-import-job', [ProductController::class, 'index'])->name('product.productImportJob');
        Route::post('/product-store-job', [ProductController::class, 'storeBulk'])->name('product.storeBulk');
        Route::get('/send-product-job-queue', [ProductController::class, 'sendProductJobQueue'])->name('product.sendProductJobQueue');


        #Phonepe
        Route::get('/phonepe/form', [PhonePeController::class, 'index'])->name('phonepe.form');
        Route::post('/phonepe/initiate', [PhonePeController::class, 'initiatePayment'])->name('phonepe.initiate');
        Route::post('/phonepe/callback', [PhonePeController::class, 'handleCallback'])->name('phonepe.callback');
        Route::get('/phonepe/refund/{merchantTransactionId}', [PhonePeController::class, 'phonePeRefund'])->name('phonepe.refund');
        Route::get('/phonepe/callback/refund', [PhonePeController::class, 'handleRefundCallback'])->name('phonepe.callback.refund');

        #QR Code
        Route::get('/qrcode', [QrCodeController::class, 'generate'])->name('qrcode');


        #Google Drive
        Route::get('/google/drive/form', [GoogleDriveController::class, 'index'])->name('google.drive.form');
        Route::post('/google/drive/upload', [GoogleDriveController::class, 'upload'])->name('google.drive.upload');
       
    });
       
});

#Used it form without login to see user details after scan the QR code
Route::get('/qrcode/user/details', [QrCodeController::class, 'userdetails'])->name('qrcode.user.details');

#Laravel Breeze
require __DIR__.'/auth.php';
