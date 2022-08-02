<?php

use App\Http\Controllers\CategoryPDController;
use App\Http\Controllers\CategoryPOController;
use App\Http\Controllers\CategoryPBController;
use App\Http\Controllers\CategoryQuotationController;
use App\Http\Controllers\PengajuanDanaController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\PembelianBarangController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryDVController;
use App\Http\Controllers\CategoryEcommerceController;
use App\Http\Controllers\CategoryPPController;
use App\Http\Controllers\CategoryPTController;
use App\Http\Controllers\DataVendorController;
use App\Http\Controllers\EcommerceController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PrivatePersonController;
use App\Models\CategoryPT;
use App\Models\DataVendor;
use App\Models\PrivatePerson;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [QuotationController::class, 'dashboard']);

Route::group(['middleware' => ['auth']], function () {


    // Route untuk Quotation
    // Quotation
    Route::group(['prefix' => 'quotation'], function () {
        Route::get('/{id}', [QuotationController::class, 'index'])->name('quotation.index');
        Route::get('/create/{id}', [QuotationController::class, 'create'])->name('quotation.create');
        Route::post('/store/{id}', [QuotationController::class, 'store'])->name('quotation.store');
        Route::get('/show/{id_company}/{id}', [QuotationController::class, 'show'])->name('quotation.show');
        Route::post('/update/{id}', [QuotationController::class, 'update'])->name('quotation.update');
        Route::get('/destroy/{id}', [QuotationController::class, 'destroy'])->name('quotation.destroy');
    });

    // Menu Quotation
    Route::group(['prefix' => 'menu-quotation'], function () {
        Route::get('/', [CategoryQuotationController::class, 'index'])->name('menu-quotation.index');
        Route::get('/create', [CategoryQuotationController::class, 'create'])->name('menu-quotation.create');
        Route::post('/store', [CategoryQuotationController::class, 'store'])->name('menu-quotation.store');
        Route::get('/destroy/{id}', [CategoryQuotationController::class, 'destroy'])->name('menu-quotation.destroy');
        Route::get('/accept/{id}', [CategoryQuotationController::class, 'accept'])->name('menu-quotation-accept');
        Route::get('/denied/{id}', [CategoryQuotationController::class, 'denied'])->name('menu-quotation-denied');
    });


    // Route untuk Pengajuan Dana
    // Pengajuan Dana
    Route::group(['prefix' => 'pengajuan-dana'], function () {
        Route::get('/{id}', [PengajuanDanaController::class, 'index'])->name('pengajuan-dana.index');
        Route::get('/create/{id}', [PengajuanDanaController::class, 'create'])->name('pengajuan-dana.create');
        Route::post('/store/{id}', [PengajuanDanaController::class, 'store'])->name('pengajuan-dana.store');
        Route::get('/show/{id_pd}/{id}', [PengajuanDanaController::class, 'show'])->name('pengajuan-dana.show');
        Route::post('/update/{id}', [PengajuanDanaController::class, 'update'])->name('pengajuan-dana.update');
        Route::get('/destroy/{id}', [PengajuanDanaController::class, 'destroy'])->name('pengajuan-dana.destroy');
    });


    // Menu Pengajuan dana
    Route::group(['prefix' => 'menu-pengajuan-dana'], function () {
        Route::get('/', [CategoryPDController::class, 'index'])->name('menu-pengajuan-dana.index');
        Route::get('/create', [CategoryPDController::class, 'create'])->name('menu-pengajuan-dana.create');
        Route::post('/store', [CategoryPDController::class, 'store'])->name('menu-pengajuan-dana.store');
        Route::get('/destroy/{id}', [CategoryPDController::class, 'destroy'])->name('menu-pengajuan-dana.destroy');
        Route::get('/accept/{id}', [CategoryPDController::class, 'accept'])->name('menu-pengajuan-dana-accept');
        Route::get('/denied/{id}', [CategoryPDController::class, 'denied'])->name('menu-pengajuan-dana-denied');
    });

    // Route untuk Pengajuan Dana


    // Route untuk Pembelian Barang
    Route::group(['prefix' => 'pembelian-barang'], function () {
        Route::get('/{id}', [PembelianBarangController::class, 'index'])->name('pembelian-barang.index');
        Route::get('/create/{id}', [PembelianBarangController::class, 'create'])->name('pembelian-barang.create');
        Route::post('/store/{id}', [PembelianBarangController::class, 'store'])->name('pembelian-barang.store');
        Route::get('/show/{pb_id}/{id}', [PembelianBarangController::class, 'show'])->name('pembelian-barang.show');
        Route::post('/update/{id}', [PembelianBarangController::class, 'update'])->name('pembelian-barang.update');
        Route::get('/destroy/{id}', [PembelianBarangController::class, 'destroy'])->name('pembelian-barang.destroy');
    });
    // Menu Pembelian Barang
    ROute::group(['prefix' => 'menu-pembelian-barang'], function () {
        Route::get('/', [CategoryPBController::class, 'index'])->name('menu-pembelian-barang.index');
        Route::get('/create', [CategoryPBController::class, 'create'])->name('menu-pembelian-barang.create');
        Route::post('/store', [CategoryPBController::class, 'store'])->name('menu-pembelian-barang.store');
        Route::get('/destroy/{id}', [CategoryPBController::class, 'destroy'])->name('menu-pembelian-barang.destroy');
        Route::get('/accept/{id}', [CategoryPBController::class, 'accept'])->name('menu-pembelian-barang-accept');
        Route::get('/denied/{id}', [CategoryPBController::class, 'denied'])->name('menu-pembelian-barang-denied');
    });
    // Route untuk Pembelian Barang

    // Route untuk Purchase Order
    Route::group(['prefix' => 'purchase-order'], function () {
        Route::get('/{id}', [PurchaseOrderController::class, 'index'])->name('purchase-order.index');
        Route::get('/create/{id}', [PurchaseOrderController::class, 'create'])->name('purchase-order.create');
        Route::post('/store/{id}', [PurchaseOrderController::class, 'store'])->name('purchase-order.store');
        Route::get('/show/{id_company}/{id}', [PurchaseOrderController::class, 'show'])->name('purchase-order.show');
        Route::post('/update/{id}', [PurchaseOrderController::class, 'update'])->name('purchase-order.update');
        Route::post('/destroy/{id}', [PurchaseOrderController::class, 'destroy'])->name('purchase-order.destroy');
    });

    // Menu Purchase Order
    Route::group(['prefix' => 'menu-purchase-order'], function () {
        Route::get('/', [CategoryPOController::class, 'index'])->name('menu-purchase-order.index');
        Route::get('/create', [CategoryPOController::class, 'create'])->name('menu-purchase-order.create');
        Route::post('/store', [CategoryPOController::class, 'store'])->name('menu-purchase-order.store');
        Route::get('/destroy/{id}', [CategoryPOController::class, 'destroy'])->name('menu-purchase-order.destroy');
        Route::get('/accept/{id}', [CategoryPOController::class, 'accept'])->name('menu-purchase-order-accept');
        Route::get('/denied/{id}', [CategoryPOController::class, 'denied'])->name('menu-purchase-order-denied');
    });


    // //Data Vendor
    // Route::get('/data-vendor', [DataVendorController::class, 'index'])->name('datavendor.index');
    // Route::get('/create-vendor', [DataVendorController::class, 'create'])->name('datavendor.create');
    // Route::post('/store-vendor', [DataVendorController::class, 'store'])->name('datavendor.store');
    // Route::get('/show-vendor/{id}', [DataVendorController::class, 'show'])->name('datavendor.show');
    // Route::post('/update/{id}', [DataVendorController::class, 'update']);
    // Route::get('/destroy/{id}', [DataVendorController::class, 'destroy']);

    // Route untuk Data Vendor Perusahaan
    Route::group(['prefix' => 'perusahaan'], function () {
        Route::get('/{id}', [PerusahaanController::class, 'index'])->name('perusahaan.index');
        Route::get('/detail/{id}', [PerusahaanController::class, 'detail'])->name('perusahaan.detail');
        Route::get('/create/{id}', [PerusahaanController::class, 'create'])->name('perusahaan.create');
        Route::post('/store/{id}', [PerusahaanController::class, 'store'])->name('perusahaan.store');
        Route::get('/show/{id_company}/{id}', [PerusahaanController::class, 'show'])->name('perusahaan.show');
        Route::post('/update/{id}', [PerusahaanController::class, 'update'])->name('perusahaan.update');
        Route::post('/destroy/{id}', [PerusahaanController::class, 'destroy'])->name('perusahaan.destroy');
    });

    // Menu Data vendor perusahaan
    Route::group(['prefix' => 'menu-perusahaan'], function () {
        Route::get('/', [CategoryPTController::class, 'index'])->name('menu-perusahaan.index');
        Route::get('/create', [CategoryPTController::class, 'create'])->name('menu-perusahaan.create');
        Route::post('/store', [CategoryPTController::class, 'store'])->name('menu-perusahaan.store');
        Route::get('/edit/{id}', [CategoryPTController::class, 'edit'])->name('menu-perusahaan.edit');
        Route::post('/update/{id}', [CategoryPTController::class, 'update'])->name('menu-perusahaan.update');
        Route::get('/destroy/{id}', [CategoryPTController::class, 'destroy'])->name('menu-perusahaan.destroy');
    });

    // Route untuk vendor Private Person
    Route::group(['prefix' => 'private-person'], function () {
        Route::get('/{id}', [PrivatePersonController::class, 'index'])->name('private-person.index');
        Route::get('/detail/{id}', [PrivatePersonController::class, 'detail'])->name('perusahaan.detail');
        Route::get('/create/{id}', [PrivatePersonController::class, 'create'])->name('private-person.create');
        Route::post('/store/{id}', [PrivatePersonController::class, 'store'])->name('private-person.store');
        Route::get('/show/{id_company}/{id}', [PrivatePersonController::class, 'show'])->name('private-person.show');
        Route::post('/update/{id}', [PrivatePersonController::class, 'update'])->name('private-person.update');
        Route::post('/destroy/{id}', [PrivatePersonController::class, 'destroy'])->name('private-person.destroy');
    });

    // Menu vendor menu Private Person
    Route::group(['prefix' => 'menu-private-person'], function () {
        Route::get('/', [CategoryPPController::class, 'index'])->name('menu-private-person.index');
        Route::get('/create', [CategoryPPController::class, 'create'])->name('menu-private-person.create');
        Route::post('/store', [CategoryPPController::class, 'store'])->name('menu-private-person.store');
        Route::get('/edit/{id}', [CategoryPPController::class, 'edit'])->name('menu-private-person.edit');
        Route::post('/update/{id}', [CategoryPPController::class, 'update'])->name('menu-private-person.update');
        Route::get('/destroy/{id}', [CategoryPPController::class, 'destroy'])->name('menu-private-person.destroy');
    });

    // Route untuk vendor Ecommerce
    Route::group(['prefix' => 'ecommerce'], function () {
        Route::get('/{id}', [EcommerceController::class, 'index'])->name('ecommerce.index');
        Route::get('/detail/{id}', [EcommerceController::class, 'detail'])->name('perusahaan.detail');
        Route::get('/create/{id}', [EcommerceController::class, 'create'])->name('ecommerce.create');
        Route::post('/store/{id}', [EcommerceController::class, 'store'])->name('ecommerce.store');
        Route::get('/show/{id_company}/{id}', [EcommerceController::class, 'show'])->name('ecommerce.show');
        Route::post('/update/{id}', [EcommerceController::class, 'update'])->name('ecommerce.update');
        Route::post('/destroy/{id}', [EcommerceController::class, 'destroy'])->name('ecommerce.destroy');
    });

    // Menu vendor menu Ecommerce
    Route::group(['prefix' => 'menu-ecommerce'], function () {
        Route::get('/', [CategoryEcommerceController::class, 'index'])->name('menu-ecommerce.index');
        Route::get('/create', [CategoryEcommerceController::class, 'create'])->name('menu-ecommerce.create');
        Route::post('/store', [CategoryEcommerceController::class, 'store'])->name('menu-ecommerce.store');
        Route::get('/edit/{id}', [CategoryEcommerceController::class, 'edit'])->name('menu-ecommerce.edit');
        Route::post('/update/{id}', [CategoryEcommerceController::class, 'update'])->name('menu-ecommerce.update');
        Route::get('/destroy/{id}', [CategoryEcommerceController::class, 'destroy'])->name('menu-ecommerce.destroy');
    });

    //admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/create-admin', [AdminController::class, 'create']);
    Route::get('/show-admin/{id}', [AdminController::class, 'show']);
    Route::post('/store-admin', [AdminController::class, 'store']);
    Route::post('/admin-update/{id}', [AdminController::class, 'update']);
    Route::get('/admin-destroy/{id}', [AdminController::class, 'destroy']);

    //Route excel
    Route::get('/export_excel/pengajuan_dana/{id}', [PengajuanDanaController::class, 'export'])->name('export-pd');
    Route::get('/export_excel/quotation/{id}', [QuotationController::class, 'export'])->name('export-qt');
    Route::get('/export_excel/purchase_order/{id}', [PurchaseOrderController::class, 'export'])->name('export-po');
    Route::get('/export_excel/pembelian_barang/{id}', [PembelianBarangController::class, 'export'])->name('export-pb');
    Route::get('/export_excel/vendor/{id}', [DataVendorController::class, 'export'])->name('export-dv');
    Route::get('/export_excel/perusahaan/{id}', [CategoryPTController::class, 'export'])->name('export-pt');
});

Auth::routes();
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
