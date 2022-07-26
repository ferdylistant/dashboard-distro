<?php

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\VendorUserController;

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

Route::get('/', function () {
    $data = [
        'user' => User::where('email', Auth::user()->email)->firstOrFail(),
        'vendor' => User::where('account_role', 'vendor')->get(),
        'cashier' => User::where('account_role', 'cashier')->get(),
        'product' => Product::all(),
    ];
    return view('pages.dashboard', $data);
})->middleware('auth');
Route::get('/login', [UserAuthController::class,"loginView"])->name('login');
Route::post('/do-login', [UserAuthController::class,"doLogin"]);
Route::get('/logout', [UserAuthController::class,"logout"])->name('logout');
Route::get('/api-vendor', [ApiController::class,"getVendor"])->name('api-vendor')->middleware('auth');
Route::prefix('vendor')->group(function () {
    Route::get('/all', [VendorUserController::class,"allVendor"])->name('vendor.all')->middleware('auth');
    Route::get('/show/{id}', [VendorUserController::class,"showVendor"])->name('vendor.show')->middleware('auth');
    Route::post('/add-action', [VendorUserController::class,"addVendor"])->name('vendor.add')->middleware('auth');
    Route::get('/edit/{id}', [VendorUserController::class,"editVendor"])->name('vendor.edit')->middleware('auth');
    Route::post('/update/{id}', [VendorUserController::class,"updateVendor"])->name('vendor.update')->middleware('auth');
    Route::get('/delete/{id}', [VendorUserController::class,"deleteVendor"])->name('vendor.delete')->middleware('auth');
});
