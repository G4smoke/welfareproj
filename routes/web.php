<?php
namespace App\Exports;
use Illuminate\Support\Facades\Http;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'admin'])->name('admin.dashboard');

Route::get('user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');



Route::middleware(['auth'])->group(function () {
    Route::get('/make-payment', [PaymentController::class, 'showPaymentForm'])->name('make.payment');
    Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('process.payment');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/user/payment-history', [PaymentController::class, 'userPaymentHistory'])->name('payment.user');
    Route::get('/admin/payment-history', [PaymentController::class, 'adminPaymentHistory'])->name('payment.admin');
});

Route::get('/admin/payment-record', [PaymentController::class, 'adminPaymentRecord'])->name('admin.record');

Route::post('/pay', [PaymentController::class, 'processPayment'])->name('pay');
Route::get('/payment/callback', [PaymentController::class, 'handleCallback'])->name('payment.callback');





Route::get('/payments/export', [PaymentController::class, 'export'])->name('payments.export');