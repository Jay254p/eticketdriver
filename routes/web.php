<?php

use App\Http\Controllers\OffenseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppealController;
use App\Http\Controllers\AppealIndexController;
use App\Http\Controllers\WebhookController;
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
Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/receipts', [ReceiptController::class, 'index'])->name('receipts.index');
    Route::get('/receipts/{ticketId}', [ReceiptController::class, 'show'])->name('receipts.show');
    Route::get('/receipts/{ticketId}/download', [ReceiptController::class, 'download'])->name('receipt.download');
    Route::get('/appeal/{ticketId}', [AppealController::class, 'appealAction'])->name('appeal');
    Route::get('/appeals', [AppealIndexController::class, 'index'])->name('appeals.show');
    



});

Route::middleware(['auth'])->name('offences.')->prefix('offences')->group(function () {
    Route::get('/', [OffenseController::class, 'index'])->name('index');
    Route::get('/search', [OffenseController::class, 'search'])->name('search');
    Route::get('/offence/payment/{ticketid}', [PaymentController::class, 'create'])->name('payment.create');

});
// Route::get('/payment', [PaymentController::class, 'create'])->name('payment.create');
Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('/payment/success/{ticketid}', [PaymentController::class, 'showPaymentSuccess'])->name('payment.success');
Route::get('/payment/success/{ticketid}/download', [PaymentController::class, 'downloadReceipt'])->name('payment.success.download');



Route::get('/payment/failure', function () {
    return "Payment Failed!";
})->name('payment.failure');

Route::match(['get', 'post'], '/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');


Route::get('/payment/status/{TicketId}', [PaymentController::class, 'checkPaymentStatus'])->name('payment.status');


require __DIR__.'/auth.php';
