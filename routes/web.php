<?php

use App\Models\Item;
use App\Models\ItemIn;
use App\Models\ItemOut;
use App\Models\Customer;
use App\Models\User;
use App\Models\Supplier;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FifoController;
use App\Http\Controllers\FefoController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemInController;
use App\Http\Controllers\ItemOutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionsController;


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
Route::group(['namespace' => 'App\Http\Controllers'], function(){


    Route::group(['middleware' => ['guest']], function(){

        Route::get('/login', [LoginController::class, 'show'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
    });

    Route::group(['middleware' => ['auth']], function(){
        Route::get('/', function () {
            $item = Item::count();
            $itemIn = ItemIn::count();
            $itemOut = ItemOut::count();
            $supplier = Supplier::count();
            $customer = Customer::count();
            $operator = User::role('operator')->count();
            $report = Item::count() + ItemIn::count() + ItemOut::count();

            return view('dashboard', compact('item','itemIn', 'itemOut', 'customer', 'supplier', 'operator', 'report'));
        });
        Route::group(['prefix' => 'barang'], function(){
            Route::get('/', [ItemController::class, 'index'])->name('item');
            Route::post('/', [ItemController::class, 'store'])->name('item.store');
            Route::get('/detail/{id}', [ItemController::class, 'show'])->name('item.show');
            Route::get('/edit/{id}', [ItemController::class, 'edit'])->name('item.edit');
            Route::post('/update', [ItemController::class, 'update'])->name('item.update');
            Route::get('/destroy/{id}', [ItemController::class, 'destroy'])->name('item.destroy');
            Route::post('/import', [ItemController::class, 'import'])->name('item.import');
            Route::get('/export', [ItemController::class, 'export'])->name('item.export');
        });
        Route::group(['prefix' => 'barangMasuk'], function(){
            Route::get('/', [ItemInController::class, 'index'])->name('itemIn');
            Route::post('/', [ItemInController::class, 'store'])->name('itemIn.store');
            Route::get('/edit/{id}', [ItemInController::class, 'edit'])->name('itemIn.edit');
            Route::post('/update', [ItemInController::class, 'update'])->name('itemIn.update');
            Route::get('/destroy/{id}', [ItemInController::class, 'destroy'])->name('itemIn.destroy');
            Route::get('/export', [ItemInController::class, 'export'])->name('itemIn.export');
        });
        Route::group(['prefix' => 'barangKeluar'], function(){
            Route::get('/', [ItemOutController::class, 'index'])->name('itemOut');
            Route::post('/', [ItemOutController::class, 'store'])->name('itemOut.store');
            Route::get('/edit/{id}', [ItemOutController::class, 'edit'])->name('itemOut.edit');
            Route::post('/update', [ItemOutController::class, 'update'])->name('itemOut.update');
            Route::get('/destroy/{id}', [ItemOutController::class, 'destroy'])->name('itemOut.destroy');
            Route::get('/export', [ItemOutController::class, 'export'])->name('itemOut.export');

        });
        Route::group(['prefix' => 'supplier'], function(){
            Route::get('/', [SupplierController::class, 'index'])->name('supplier');
            Route::post('/', [SupplierController::class, 'store'])->name('supplier.store');
            Route::get('/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
            Route::post('/update', [SupplierController::class, 'update'])->name('supplier.update');
            Route::get('/destroy/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');
            Route::post('/import', [SupplierController::class, 'import'])->name('supplier.import');
            Route::get('/export', [SupplierController::class, 'export'])->name('supplier.export');

        });
        Route::group(['prefix' => 'operator'], function(){
            Route::get('/', [OperatorController::class, 'index'])->name('operator');
            Route::post('/', [OperatorController::class, 'store'])->name('operator.store');
            Route::get('/edit/{id}', [OperatorController::class, 'edit'])->name('operator.edit');
            Route::post('/update', [OperatorController::class, 'update'])->name('operator.update');
            Route::get('/destroy/{id}', [OperatorController::class, 'destroy'])->name('operator.destroy');
        });
        Route::group(['prefix' => 'pelanggan'], function(){
            Route::get('/', [CustomerController::class, 'index'])->name('customer');
            Route::post('/', [CustomerController::class, 'store'])->name('customer.store');
            Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
            Route::post('/update', [CustomerController::class, 'update'])->name('customer.update');
            Route::get('/destroy/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

        });
        Route::group(['prefix' => 'fifo'], function(){

            Route::get('/', [FifoController::class, 'fifo'])->name('fifo');
            Route::get('/export', [FifoController::class, 'export'])->name('fifo.export');
        });
        Route::group(['prefix' => 'fefo'], function(){

            Route::get('/', [FefoController::class, 'fefo'])->name('fefo');
            Route::get('/export', [FefoController::class, 'export'])->name('fefo.export');
        });
        Route::group(['prefix' => 'report'], function(){

            Route::get('/', [ReportController::class, 'index'])->name('report');
        });
        Route::group(['prefix' => 'transaction'], function(){

            Route::get('/', [TransactionController::class, 'index'])->name('transaction');
        });
        Route::get('/logout', [LogoutController::class, 'perform'])->name('logout.perform');
    });


});


Route::resource('roles', RolesController::class);
Route::resource('permissions', PermissionsController::class);














