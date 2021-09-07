<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\TransactionController;

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

// CurrencyController
Route::middleware('auth', 'balance')->group(function () {
    Route::get('/', [CurrencyController::class, 'index'])->name('home');
    Route::get('/home', [CurrencyController::class, 'index']);
    Route::prefix('currencies')->name('currencies.')->group(function () {
        Route::get('/', [CurrencyController::class, 'index'])->name('index');
        Route::middleware('client')->get('/{currency}', [CurrencyController::class, 'show'])->name('show');
    });

    // transactions
    Route::middleware('client')->prefix('transactions')->name('transactions.')->group(function () {
        Route::get('/{currency?}', [TransactionController::class, 'index'])->name('index');
        Route::get('/create/{currency}', [TransactionController::class, 'create'])->name('create');
        Route::post('/', [TransactionController::class, 'store'])->name('store');
        Route::patch('/{currency}/{transaction?}', [TransactionController::class, 'update'])->name('update');
        Route::get('/sell/{currency}', [TransactionController::class, 'sell'])->name('sell');
    });

    Route::middleware('admin')->resource('users', 'UserController')->except(['show']);

    // profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/edit', [UserController::class, 'editProfile'])->name('edit');
        Route::patch('/{user}', [UserController::class, 'updateProfile'])->name('update');
    });

    Route::middleware('client')->get('/wallet', [WalletController::class, 'index'])->name('wallet');
});

Route::prefix('api')->name('api.')->group(function () {
    Route::get('/get-price/{fsym}', function ($fsym) {
        $api = new App\Models\API;
        return $api->getPrice($fsym);
    })->name('get-price');
});

Auth::routes();
