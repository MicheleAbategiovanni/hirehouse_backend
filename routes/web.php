<?php

use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\PaymentController;
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

// Rotta pagamento effettivo (API) 
Route::post('/payment/process', [PaymentController::class,"process"])->name('payment.process');

// View per inserimento dati carta
Route::get('/payment/{sponsor}/{apartment}', [PaymentController::class,"show"])->name('payment.show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')
    ->prefix("admin") // porzione di uri che verrà inserita prima di ogni rotta
    ->name("admin.") // porzione di testo inserita prima del name di ogni rotta
    ->group(function () {
        Route::get("/",[DashboardController::class,"home"])->name("dashboard");
        Route::resource("apartments",ApartmentController::class);
        Route::get("apartment/messages/{apartment}",[MessageController::class,"index"])->name("messages.index");
        Route::delete("apartment/messages/{message}",[MessageController::class,"destroy"])->name("messages.delete");
        Route::get("apartment/sponsors/{apartment}",[SponsorController::class,"index"])->name("sponsors.index");

        Route::get("sponsor/{apartment}/{sponsor}",[ApartmentController::class,"addSponsor"])->name("sponsors.add");
        
    
    
    
    });

    


require __DIR__.'/auth.php';
