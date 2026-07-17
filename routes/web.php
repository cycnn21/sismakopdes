<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\AdminDashboardController;

use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserBarangController;
use App\Http\Controllers\User\KeranjangController;

use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;


/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landing.index');
});



/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login/admin', [AuthController::class, 'admin'])
    ->name('login.admin');


Route::post('/login/admin', [AuthController::class, 'authenticateAdmin'])
    ->name('authenticate.admin');


Route::get('/login/user', [AuthController::class, 'user'])
    ->name('login.user');


Route::post('/login/user', [AuthController::class, 'authenticateUser'])
    ->name('authenticate.user');


Route::get('/register', [AuthController::class, 'register'])
    ->name('register');


Route::post('/register', [AuthController::class, 'storeRegister'])
    ->name('register.store');


Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');



/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */


    Route::get(
        '/admin/dashboard',
        [AdminDashboardController::class, 'index']
    )->name('admin.dashboard');



    Route::get(
        '/user/dashboard',
        [UserDashboardController::class, 'index']
    )->name('user.dashboard');




    /*
    |--------------------------------------------------------------------------
    | Master Data Admin
    |--------------------------------------------------------------------------
    */


    Route::resource(
        'kategori',
        KategoriBarangController::class
    );


    Route::resource(
        'supplier',
        SupplierController::class
    );


    Route::patch(
        '/supplier/{supplier}/toggle-status',
        [SupplierController::class, 'toggleStatus']
    )->name('supplier.toggleStatus');


    Route::resource(
        'barang',
        BarangController::class
    );




    /*
    |--------------------------------------------------------------------------
    | Transaksi Gudang
    |--------------------------------------------------------------------------
    */


    Route::resource(
        'barang-masuk',
        BarangMasukController::class
    );


    Route::resource(
        'barang-keluar',
        BarangKeluarController::class
    );





    /*
    |--------------------------------------------------------------------------
    | User / Pembelian
    |--------------------------------------------------------------------------
    */


    Route::prefix('user')
        ->name('user.')
        ->group(function () {



            /*
            |--------------------------------------------------------------------------
            | Dashboard User
            |--------------------------------------------------------------------------
            */


            Route::get(
                '/dashboard',
                [UserDashboardController::class, 'index']
            )->name('dashboard');





            /*
            |--------------------------------------------------------------------------
            | Katalog Barang
            |--------------------------------------------------------------------------
            */


            Route::get(
                '/katalog',
                [UserBarangController::class, 'index']
            )->name('katalog.index');


            Route::get(
                '/katalog/{barang}',
                [UserBarangController::class, 'show']
            )->name('katalog.show');






            /*
            |--------------------------------------------------------------------------
            | Keranjang
            |--------------------------------------------------------------------------
            */


            Route::resource(
                'keranjang',
                KeranjangController::class
            );






            /*
            |--------------------------------------------------------------------------
            | Riwayat Pembelian
            |--------------------------------------------------------------------------
            */


            Route::get(
                '/riwayat',
                function () {

                    return view('user.riwayat.index');

                }
            )->name('riwayat.index');







            /*
            |--------------------------------------------------------------------------
            | Profil User
            |--------------------------------------------------------------------------
            */


            Route::get(
                '/profile',
                function () {

                    return view('user.profile.index');

                }
            )->name('profile.index');



        });



});