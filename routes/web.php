<?php

use App\Http\Controllers\ProjectCodeCreatesController;
use App\Http\Controllers\CategoryPDController;
use App\Http\Controllers\CategoryPOController;
use App\Http\Controllers\PengajuanDanaController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\PembelianBarangController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ActivityLogsController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryEcommerceController;
use App\Http\Controllers\CategoryPengajuanPembelianController;
use App\Http\Controllers\CategoryPPController;
use App\Http\Controllers\CategoryPTController;
use App\Http\Controllers\CategoryTaskListController;
use App\Http\Controllers\CheckPOController;
use App\Http\Controllers\DataVendorController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EcommerceController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InvoicingController;
use App\Http\Controllers\NotifPaymentController;
use App\Http\Controllers\NotifPengajuanController;
use App\Http\Controllers\NotifPOController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PengajuanPembelianController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PrivatePersonController;
use App\Http\Controllers\ReferensiNamaProjectController;
use App\Http\Controllers\RNDController;
use App\Http\Controllers\TaskListAtasanController;
use App\Http\Controllers\TasklistAtasanPaymentController;
use App\Http\Controllers\TasklistAtasanPoController;
use App\Http\Controllers\TaskListFinanceController;
use App\Http\Controllers\WhoSubmittedController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ItemHistoryController;
use App\Http\Controllers\SendWaController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\ForceResetPassword;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\PrePrController;
use App\Http\Controllers\UomController;
use App\Http\Controllers\PrePRCommentsController;
use App\Http\Controllers\IsReadPrePRCommentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

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

// Route::get('/info',function(){
//     phpinfo();
// });

Route::get('/',function () {
    return redirect()->route('login');
})->middleware('maintenance.mode');

Route::get('/forgot_password',function(){
    return view('auth.passwords.email');
})->name('forget_password')->middleware('maintenance.mode');


Route::group(['middleware' => ['auth','maintenance.mode']], function () {
     //forceReset
     Route::get('/resetPage',[ForceResetPassword::class,'showForm'])->name('resetPage');
     Route::post('/pushResetPassword',[ForceResetPassword::class,'resetPassword'])->name('pushReset');
    Route::group(['middleware' => ['force_password_reset']], function(){

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');


    //Vendor
    // Route untuk Data Vendor Perusahaan
    Route::group(['prefix' => 'perusahaan'], function () {
        Route::get('/{id}', [PerusahaanController::class, 'index'])->name('perusahaan.index');
        Route::get('/detail/{id}', [PerusahaanController::class, 'detail'])->name('perusahaan.detail');
        Route::get('/create/{id}', [PerusahaanController::class, 'create'])->name('perusahaan.create');
        Route::post('/store/{id}', [PerusahaanController::class, 'store'])->name('perusahaan.store');
        Route::get('/show/{id_company}/{id}', [PerusahaanController::class, 'show'])->name('perusahaan.show');
        Route::post('/update/{id}', [PerusahaanController::class, 'update'])->name('perusahaan.update');
        Route::delete('/destroy/{id}', [PerusahaanController::class, 'destroy'])->name('perusahaan.destroy');
        Route::get('/search/company',[PerusahaanController::class, 'SearchCompany'])->name('perusaahaan.SearchCompany');
    });

    // Menu Data vendor perusahaan
    Route::group(['prefix' => 'menu-perusahaan'], function () {
        Route::get('/', [CategoryPTController::class, 'index'])->name('menu-perusahaan.index');
        Route::get('/detail/{id}', [CategoryPTController::class, 'detail'])->name('menu-perusahaan.detail');
        Route::get('/create', [CategoryPTController::class, 'create'])->name('menu-perusahaan.create');
        Route::post('/store', [CategoryPTController::class, 'store'])->name('menu-perusahaan.store');
        Route::get('/edit/{id}', [CategoryPTController::class, 'edit'])->name('menu-perusahaan.edit');
        Route::post('/update/{id}', [CategoryPTController::class, 'update'])->name('menu-perusahaan.update');
        Route::delete('/destroy/{id}', [CategoryPTController::class, 'destroy'])->name('menu-perusahaan.destroy');
        Route::get('/search/company',[CategoryPTController::class, 'SearchPT'])->name('menu-perusahaan.SearchPT');
    });

    // // Route untuk vendor Private Person
    // Route::group(['prefix' => 'private-person'], function () {
    //     Route::get('/{id}', [PrivatePersonController::class, 'index'])->name('private-person.index');
    //     Route::get('/detail/{id}', [PrivatePersonController::class, 'detail'])->name('perusahaan.detail');
    //     Route::get('/create/{id}', [PrivatePersonController::class, 'create'])->name('private-person.create');
    //     Route::post('/store/{id}', [PrivatePersonController::class, 'store'])->name('private-person.store');
    //     Route::get('/show/{id_company}/{id}', [PrivatePersonController::class, 'show'])->name('private-person.show');
    //     Route::post('/update/{id}', [PrivatePersonController::class, 'update'])->name('private-person.update');
    //     Route::delete('/destroy/{id}', [PrivatePersonController::class, 'destroy'])->name('private-person.destroy');
    //     // Route::get('/search/pp',[CategoryPengajuanPembelianController::class, 'SearchPP'])->name('private-person.SearchP');
    // });

    // Menu vendor menu Private Person
    Route::group(['prefix' => 'menu-private-person'], function () {
        Route::get('/', [CategoryPPController::class, 'index'])->name('menu-private-person.index');
        Route::get('/create', [CategoryPPController::class, 'create'])->name('menu-private-person.create');
        Route::get('/detail/{id}', [CategoryPPController::class, 'detail'])->name('menu-private-person.detail');
        Route::post('/store', [CategoryPPController::class, 'store'])->name('menu-private-person.store');
        Route::get('/edit/{id}', [CategoryPPController::class, 'edit'])->name('menu-private-person.edit');
        Route::post('/update/{id}', [CategoryPPController::class, 'update'])->name('menu-private-person.update');
        Route::delete('/destroy/{id}', [CategoryPPController::class, 'destroy'])->name('menu-private-person.destroy');
        Route::get('/search/pp',[CategoryPPController::class, 'SearchPP'])->name('menu-private-person.SearchPP');
    });

    // Route untuk vendor Ecommerce
    Route::group(['prefix' => 'ecommerce'], function () {
        
        Route::get('/{id}', [EcommerceController::class, 'index'])->name('ecommerce.index');
        Route::get('/detail/{id}', [EcommerceController::class, 'detail'])->name('perusahaan.detail');
        Route::get('/create/{id}', [EcommerceController::class, 'create'])->name('ecommerce.create');
        Route::post('/store/{id}', [EcommerceController::class, 'store'])->name('ecommerce.store');
        Route::get('/show/{id_company}/{id}', [EcommerceController::class, 'show'])->name('ecommerce.show');
        Route::post('/update/{id}', [EcommerceController::class, 'update'])->name('ecommerce.update');
        Route::delete('/destroy/{id}', [EcommerceController::class, 'destroy'])->name('ecommerce.destroy');
        Route::get('/search/prq',[CategoryPengajuanPembelianController::class, 'SearchPRQ'])->name('menu-pengajuan-pembelian.SearchPRQ');
    });

    // Menu vendor menu Ecommerce
    Route::group(['prefix' => 'menu-ecommerce'], function () {
        Route::get('/', [CategoryEcommerceController::class, 'index'])->name('menu-ecommerce.index');
        Route::get('/create', [CategoryEcommerceController::class, 'create'])->name('menu-ecommerce.create');
        Route::post('/store', [CategoryEcommerceController::class, 'store'])->name('menu-ecommerce.store');
        Route::get('/edit/{id}', [CategoryEcommerceController::class, 'edit'])->name('menu-ecommerce.edit');
        Route::post('/update/{id}', [CategoryEcommerceController::class, 'update'])->name('menu-ecommerce.update');
        Route::delete('/destroy/{id}', [CategoryEcommerceController::class, 'destroy'])->name('menu-ecommerce.destroy');
        Route::get('/search/ecommerce',[CategoryEcommerceController::class, 'SearchEC'])->name('menu-ecommerce.SearchEC');
    });
    //end Vendor

    // Data Master Submission

    Route::group(['prefix' => 'who-submitted'], function () {
        Route::get('/', [WhoSubmittedController::class, 'index'])->name('who-submitted.index');
        Route::get('/create', [WhoSubmittedController::class, 'create'])->name('who-submitted.create');
        Route::post('/store', [WhoSubmittedController::class, 'store'])->name('who-submitted.store');
        Route::get('/edit/{id}', [WhoSubmittedController::class, 'edit'])->name('who-submitted.edit');
        Route::post('/update/{id}', [WhoSubmittedController::class, 'update'])->name('who-submitted.update');
        Route::delete('/destroy/{id}', [WhoSubmittedController::class, 'destroy'])->name('who-submitted.destroy');
        Route::get('/search/ws',[WhoSubmittedController::class, 'SearchWS'])->name('who-submitted.SearchWS');
    });

    // Project Code user
    Route::group(['prefix' => 'project-code'], function () {
        Route::get('/', [ProjectCodeCreatesController::class, 'index'])->name('project-code.index');
        Route::get('/create', [ProjectCodeCreatesController::class, 'create'])->name('project-code.create');
        Route::post('/store', [ProjectCodeCreatesController::class, 'store'])->name('project-code.store');
        Route::get('/edit/{id}', [ProjectCodeCreatesController::class, 'edit'])->name('project-code.edit');
        Route::post('/update/{id}', [ProjectCodeCreatesController::class, 'update'])->name('project-code.update');
        Route::get('/approval', [ProjectCodeCreatesController::class, 'approver'])->name('project-code.approve');
        Route::post('/accept/{id}', [ProjectCodeCreatesController::class, 'accept'])->name('project-code.accept');
        Route::post('/accept_selected', [ProjectCodeCreatesController::class, 'acceptSelect'])->name('project-code.acceptSelect');
        Route::post('/reject/{id}', [ProjectCodeCreatesController::class, 'reject'])->name('project-code.reject');
        Route::post('/reject_selected', [ProjectCodeCreatesController::class, 'rejectSelect'])->name('project-code.rejectSelect');
    });
    // End Project Code User

    Route::group(['prefix' => 'project-reference'], function () {
        Route::get('/', [ReferensiNamaProjectController::class, 'index'])->name('project-reference.index');
        Route::get('/create', [ReferensiNamaProjectController::class, 'create'])->name('project-reference.create');
        Route::post('/store', [ReferensiNamaProjectController::class, 'store'])->name('project-reference.store');
        Route::get('/edit/{id}', [ReferensiNamaProjectController::class, 'edit'])->name('project-reference.edit');
        Route::post('/update/{id}', [ReferensiNamaProjectController::class, 'update'])->name('project-reference.update');
        Route::delete('/destroy/{id}', [ReferensiNamaProjectController::class, 'destroy'])->name('project-reference.destroy');
        Route::get('/search/project',[ReferensiNamaProjectController::class, 'SearchProject'])->name('project-reference.SearchProject');
        Route::get('/export', [ReferensiNamaProjectController::class, 'exportProjectCode'])->name('project-reference.export');
    });

    Route::group(['prefix' => 'office'], function () {
        Route::get('/', [OfficeController::class, 'index'])->name('office.index');
        Route::get('/create', [OfficeController::class, 'create'])->name('office.create');
        Route::post('/store', [OfficeController::class, 'store'])->name('office.store');
        Route::get('/edit/{id}', [OfficeController::class, 'edit'])->name('office.edit');
        Route::post('/update/{id}', [OfficeController::class, 'update'])->name('office.update');
        Route::delete('/destroy/{id}', [OfficeController::class, 'destroy'])->name('office.destroy');
        Route::get('/search/office',[officeController::class, 'SearchOffice'])->name('office.SearchOffice');
    });

    Route::group(['prefix' => 'workshop'], function () {
        Route::get('/', [WorkshopController::class, 'index'])->name('workshop.index');
        Route::get('/create', [WorkshopController::class, 'create'])->name('workshop.create');
        Route::post('/store', [WorkshopController::class, 'store'])->name('workshop.store');
        Route::get('/edit/{id}', [WorkshopController::class, 'edit'])->name('workshop.edit');
        Route::post('/update/{id}', [WorkshopController::class, 'update'])->name('workshop.update');
        Route::delete('/destroy/{id}', [WorkshopController::class, 'destroy'])->name('workshop.destroy');
        Route::get('/search/workshop',[WorkshopController::class, 'SearchWorkshop'])->name('workshop.SearchWorkshop');
    });

    Route::group(['prefix' => 'inventory'], function () {
        Route::get('/', [InventoryController::class, 'index'])->name('inventory.index');
        Route::get('/create', [InventoryController::class, 'create'])->name('inventory.create');
        Route::post('/store', [InventoryController::class, 'store'])->name('inventory.store');
        Route::get('/edit/{id}', [InventoryController::class, 'edit'])->name('inventory.edit');
        Route::post('/update/{id}', [InventoryController::class, 'update'])->name('inventory.update');
        Route::delete('/destroy/{id}', [InventoryController::class, 'destroy'])->name('inventory.destroy');
        Route::get('/search/inventory',[InventoryController::class, 'SearchInventory'])->name('inventory.SearchInventory');
    });

    Route::group(['prefix' => 'RnD'], function () {
        Route::get('/', [RNDController::class, 'index'])->name('RnD.index');
        Route::get('/create', [RNDController::class, 'create'])->name('RnD.create');
        Route::post('/store', [RNDController::class, 'store'])->name('RnD.store');
        Route::get('/edit/{id}', [RNDController::class, 'edit'])->name('RnD.edit');
        Route::post('/update/{id}', [RNDController::class, 'update'])->name('RnD.update');
        Route::delete('/destroy/{id}', [RNDController::class, 'destroy'])->name('RnD.destroy');
        Route::get('/search/RnD',[RNDController::class, 'SearchRND'])->name('RnD.SearchRND');
    });

    Route::group(['prefix' => 'department'], function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('department.index');
        Route::get('/create', [DepartmentController::class, 'create'])->name('department.create');
        Route::post('/store', [DepartmentController::class, 'store'])->name('department.store');
        Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
        Route::post('/update/{id}', [DepartmentController::class, 'update'])->name('department.update');
        Route::delete('/destroy/{id}', [DepartmentController::class, 'destroy'])->name('department.destroy');
        Route::get('/search/department',[DepartmentController::class, 'SearchDepartment'])->name('department.SearchDepartment');
        Route::get('/get-permitted-purposes/{departmentId}', [DepartmentController::class, 'getPermittedPurposes']);
    });

    Route::group(['prefix' => 'travel'], function () {
        Route::get('/', [TravelController::class, 'index'])->name('travel.index');
        Route::get('/create', [TravelController::class, 'create'])->name('travel.create');
        Route::post('/store', [TravelController::class, 'store'])->name('travel.store');
        Route::get('/edit/{id}', [TravelController::class, 'edit'])->name('travel.edit');
        Route::post('/update/{id}', [TravelController::class, 'update'])->name('travel.update');
        Route::delete('/destroy/{id}', [TravelController::class, 'destroy'])->name('travel.destroy');
        Route::get('/search/travel',[TravelController::class, 'SearchTravel'])->name('travel.SearchTravel');
    });

    Route::group(['prefix' => 'bank'], function () {
        Route::get('/', [BankController::class, 'index'])->name('bank.index');
        Route::post('/store', [BankController::class, 'store'])->name('bank.store');
        Route::get('/edit/{id}', [BankController::class, 'edit'])->name('bank.edit');
        Route::post('/update/{id}', [BankController::class, 'update'])->name('bank.update');
        Route::delete('/destroy/{id}', [BankController::class, 'destroy'])->name('bank.destroy');
        Route::get('/search/bank',[BankController::class, 'SearchBank'])->name('bank.SearchBank');
        Route::post('/import/bank',[BankController::class, 'import'])->name('bank.import');
    });

    Route::group(['prefix' => 'currency'], function () {
        Route::get('/', [CurrencyController::class, 'index'])->name('currency.index');
        Route::post('/store', [CurrencyController::class, 'store'])->name('currency.store');
        Route::get('/edit/{id}', [CurrencyController::class, 'edit'])->name('currency.edit');
        Route::post('/update/{id}', [CurrencyController::class, 'update'])->name('currency.update');
        Route::delete('/destroy/{id}', [CurrencyController::class, 'destroy'])->name('currency.destroy');
        Route::get('/search/currency',[CurrencyController::class, 'Searchcurrency'])->name('currency.Searchcurrency');
        Route::post('/import/currency',[CurrencyController::class, 'import'])->name('currency.import');
    });

    Route::group(['prefix' => 'uom'], function () {
        Route::get('/', [UomController::class, 'index'])->name('uom.index');
        Route::post('/store', [UomController::class, 'store'])->name('uom.store');
        Route::get('/edit/{id}', [UomController::class, 'edit'])->name('uom.edit');
        Route::post('/update/{id}', [UomController::class, 'update'])->name('uom.update');
        Route::delete('/destroy/{id}', [UomController::class, 'destroy'])->name('uom.destroy');
        Route::get('/search/uom',[UomController::class, 'Searchuom'])->name('uom.Searchuom');
        Route::post('/import/uom',[UomController::class, 'import'])->name('uom.import');
    });

    // End Data Master Submission

    // Pre PR

    Route::group(['prefix' => 'pre-pr'], function () {
        Route::get('/', [PrePrController::class, 'index'])->name('prepr.index');
        Route::get('/detail/{id}',[PrePrController::class, 'detail'])->name('prepr.detail');
        Route::get('/search',[PrePrController::class, 'search'])->name('prepr.search');
        Route::get('/create',[PrePrController::class, 'create'])->name('prepr.create');
        Route::post('/store',[PrePrController::class, 'store'])->name('prepr.store');
        Route::get('/edit/{id}',[PrePrController::class, 'edit'])->name('prepr.edit');
        Route::post('/update/{id}',[PrePrController::class, 'update'])->name('prepr.update');
        Route::delete('/delete/{id}',[PrePrController::class, 'destroy'])->name('prepr.delete');
        Route::get('/export/{id}',[PrePrController::class, 'exportPrePR'])->name('prepr.export');
        Route::post('/import',[PrePrController::class, 'importPrePR'])->name('prepr.import');
        Route::post('/add-pr-item',[PrePrController::class, 'addItemPR'])->name('prepr.addItemPR');
    });

    //PrePRComment
    Route::get('/prepr_comments/detail/{id}',[PrePRCommentsController::class, 'detail'])->name('preprComent.detail');
    Route::post('/prepr_comment_store',[PrePRCommentsController::class, 'store'])->name('preprComent.store');
    Route::post('/prepr_comment/mark-as-read', [IsReadPrePRCommentController::class, 'markAsRead'])->name('preprCommennt.markRead');
    // End Pre PR

    // Check Logistic
    Route::group(['prefix' => 'check-logistic'], function () {
        Route::get('/', [PrePrController::class, 'check_logistic'])->name('logistic.index');
        Route::get('/history', [PrePrController::class, 'history_check_logistic'])->name('logistic.history');
        Route::get('/edit/{id}', [PrePrController::class, 'check_logistic_edit'])->name('logistic.edit');
        Route::post('/updatelogistic/{id}', [PrePrController::class, 'check_logistic_update'])->name('logistic.update');
        Route::get('/detail/{id}',[PrePrController::class, 'detail_check_logistic'])->name('logistic.detail');
        Route::get('/search',[PrePrController::class, 'search_check_logistic'])->name('logistic.search');
        Route::get('/history-search',[PreprController::class, 'SearchHistoryCheckLogistic'])->name('logistic.history.search');
        Route::post('/approve/{id}',[PrePrController::class, 'approve_check_logistic'])->name('logistic.approve');
        Route::post('/reject/{id}',[PrePrController::class, 'reject_check_logistic'])->name('logistic.reject');
        Route::post('/approveselected',[PrePrController::class, 'approve_check_logistic_selected'])->name('logistic.approveSelected');
    });
    // End Check Logistic

    // Pengajuan Pembelian
    Route::group(['prefix' => 'pengajuan-pembelian'], function () {
        Route::get('/{id}', [PengajuanPembelianController::class, 'index'])->name('pengajuan-pembelian.index');
        Route::get('/create/{id}', [PengajuanPembelianController::class, 'create'])->name('pengajuan-pembelian.create');
        Route::post('/store/{id}', [PengajuanPembelianController::class, 'store'])->name('pengajuan-pembelian.store');
        Route::get('/edit/{pp_id}/{id}', [PengajuanPembelianController::class, 'edit'])->name('pengajuan-pembelian.edit');
        Route::post('/update/{id}', [PengajuanPembelianController::class, 'update'])->name('pengajuan-pembelian.update');
        // Route::delete('/destroy/{id}', [PengajuanPembelianController::class, 'destroy'])->name('pengajuan-pembelian.destroy');
        Route::get('/search/prq',[CategoryPengajuanPembelianController::class, 'SearchPRQ'])->name('menu-pengajuan-pembelian.SearchPRQ');
    });

    Route::group(['prefix' => 'activity'], function () {
        Route::get('/', [ActivityLogsController::class, 'index'])->name('activity.index');
        Route::get('/search',[ActivityLogsController::class, 'search'])->name('activity.search');
    });

    // Menu Pengajuan pembelian
    Route::group(['prefix' => 'menu-pengajuan-pembelian'], function () {
        Route::get('/', [CategoryPengajuanPembelianController::class, 'index'])->name('menu-pengajuan-pembelian.index');
        Route::get('/detail/{id}', [CategoryPengajuanPembelianController::class, 'detail'])->name('menu-pengajuan-pembelian.detail');
        Route::get('/po_detail/{id}', [CategoryPengajuanPembelianController::class, 'po_detail'])->name('menu-pengajuan-pembelian.po_detail');
        Route::get('/history', [CategoryPengajuanPembelianController::class, 'history'])->name('menu-pengajuan-pembelian.history');
        Route::get('/history-fail', [CategoryPengajuanPembelianController::class, 'historyfail'])->name('menu-pengajuan-pembelian.historyfail');
        Route::get('/create', [CategoryPengajuanPembelianController::class, 'create'])->name('menu-pengajuan-pembelian.create');
        Route::post('/store', [CategoryPengajuanPembelianController::class, 'store'])->name('menu-pengajuan-pembelian.store');
        Route::post('/update/{id}', [CategoryPengajuanPembelianController::class, 'update'])->name('menu-pengajuan-pembelian.update');
        Route::get('/edit/{id}', [CategoryPengajuanPembelianController::class, 'edit'])->name('menu-pengajuan-pembelian.edit');
        Route::delete('/destroy/{id}', [CategoryPengajuanPembelianController::class, 'destroy'])->name('menu-pengajuan-pembelian.destroy');
        Route::get('/search/prq',[CategoryPengajuanPembelianController::class, 'SearchPRQ'])->name('menu-pengajuan-pembelian.SearchPRQ');
        Route::get('/search/historyprq',[CategoryPengajuanPembelianController::class, 'SearchHistoryPRQ'])->name('menu-pengajuan-pembelian.SearchHistoryPRQ');
        Route::get('/search/historyfailprq',[CategoryPengajuanPembelianController::class, 'SearchHistoryFailPRQ'])->name('menu-pengajuan-pembelian.SearchHistoryFailPRQ');
        Route::get('/getData/prePR/{id}',[CategoryPengajuanPembelianController::class, 'getDataPrePR'])->name('menu-pengajuan-pembelian.getDataPrePR');
    });

    //Tasklist's Super User

    // Menu Task list atasan Pengajuan Pembelian
    Route::group(['prefix' => 'menu-taskList-atasan'], function () {
        Route::get('/', [TaskListAtasanController::class, 'index'])->name('menu-taskList-atasan.index');
        Route::get('/taskSindu',[TaskListAtasanController::class, 'taskSindu'])->name('menu-taskList-atasan.Sindu');
        Route::get('/taskBayu',[TaskListAtasanController::class, 'taskBayu'])->name('menu-taskList-atasan.Bayu');
        Route::get('/taskVictor',[TaskListAtasanController::class, 'taskVictor'])->name('menu-taskList-atasan.Victor');
        Route::get('/taskErwin',[TaskListAtasanController::class, 'taskErwin'])->name('menu-taskList-atasan.Erwin');
        Route::get('/taskTriyani',[TaskListAtasanController::class, 'taskTriyani'])->name('menu-taskList-atasan.Triyani');
        Route::get('/edit/{id}', [TaskListAtasanController::class, 'edit'])->name('menu-taskList-atasan.edit');
        Route::post('/update/{id}', [TaskListAtasanController::class, 'update'])->name('menu-taskList-atasan.update');
        Route::get('/history', [TaskListAtasanController::class, 'history'])->name('menu-taskList-atasan.history');
        Route::get('/detail/{id}', [TaskListAtasanController::class, 'detail'])->name('menu-taskList-atasan.detail');
        Route::get('/po_detail/{id}', [TaskListAtasanController::class, 'po_detail'])->name('menu-taskList-atasan.po_detail');
        // Route::delete('/destroy/{id}', [TaskListAtasanController::class, 'destroy'])->name('menu-taskList-atasan.destroy');
        Route::get('/accept_atasan/{id}', [TaskListAtasanController::class, 'accept_atasan'])->name('menu-taskList-atasan-accept_atasan');
        Route::get('/accept_atasan_selected', [TaskListAtasanController::class, 'accept_atasan_selected'])->name('menu-taskList-atasan.accept_atasan_selected');
        Route::get('/reject_atasan_selected', [TaskListAtasanController::class, 'reject_atasan_selected'])->name('menu-taskList-atasan.reject_atasan_selected');
        Route::get('/reject/{id}', [TaskListAtasanController::class, 'reject'])->name('menu-taskList-atasan-reject');
        Route::get('/in/search/tasksrequestbodIn',[TaskListAtasanController::class, 'SearchTaskRequestBodIn'])->name('menu-taskList-atasan.SearchTaskRequestBodIn');
        Route::get('/search/history/pr',[TaskListAtasanController::class, 'SearchTaskRequestBodOut'])->name('menu-taskList-atasan.SearchTaskRequestBodOut');
        Route::get('/history/search/historyRequestTask',[TaskListAtasanController::class, 'SearchHistoryRequestTask'])->name('menu-taskList-atasan.SearchHistoryRequestTask');
        Route::get('/history/sortPrBod',[TaskListAtasanController::class, 'SortHistoryPrBod'])->name('menu-taskList-atasan.SortHistoryPrBod');
    });

     // Menu Task list atasan Purchase Order
     Route::group(['prefix' => 'menu-taskList-atasan-po'], function () {
        Route::get('/', [TasklistAtasanPoController::class, 'index'])->name('menu-taskList-atasan-po.index');
        Route::get('/taskPoSindu', [TasklistAtasanPoController::class, 'taskPoSindu'])->name('menu-taskList-atasan-po.sindu');
        Route::get('/taskPoBayu', [TasklistAtasanPoController::class, 'taskPoBayu'])->name('menu-taskList-atasan-po.bayu');
        Route::get('/taskPoVictor', [TasklistAtasanPoController::class, 'taskPoVictor'])->name('menu-taskList-atasan-po.victor');
        Route::get('/taskPoErwin', [TasklistAtasanPoController::class, 'taskPoErwin'])->name('menu-taskList-atasan-po.erwin');
        Route::get('/taskPoTriyani', [TasklistAtasanPoController::class, 'taskPoTriyani'])->name('menu-taskList-atasan-po.triyani');
        Route::get('/out', [TasklistAtasanPoController::class, 'out'])->name('menu-taskList-atasan-po.out');
        Route::get('/history', [TasklistAtasanPoController::class, 'history'])->name('menu-taskList-atasan-po.history');
        Route::get('/detail/{id}', [TasklistAtasanPoController::class, 'detail'])->name('menu-taskList-atasan-po.detail');
        Route::get('/po_detail/{id}', [TasklistAtasanPoController::class, 'po_detail'])->name('menu-taskList-atasan-po.po_detail');
        Route::post('/update/{id}', [TasklistAtasanPoController::class, 'update'])->name('menu-taskList-atasan-po.update');
        Route::get('/edit/{id}', [TasklistAtasanPoController::class, 'edit'])->name('menu-taskList-atasan-po.edit');
        // Route::delete('/destroy/{id}', [TasklistAtasanPoController::class, 'destroy'])->name('menu-taskList-atasan-po.destroy');
        Route::get('/accept_atasan/{id}', [TasklistAtasanPoController::class, 'accept_atasan'])->name('menu-taskList-atasan-po-accept_atasan');
        Route::get('/reject/{id}', [TasklistAtasanPoController::class, 'reject'])->name('menu-taskList-atasan-po-reject');
        Route::get('/in/search/atasanpoIn',[TasklistAtasanPoController::class, 'SearchAtasanPOIn'])->name('menu-taskList-atasan-po.SearchAtasanPOIn');
        Route::get('/search/history/po',[TasklistAtasanPoController::class, 'SearchAtasanPOOut'])->name('menu-taskList-atasan-po.SearchAtasanPOOut');
        Route::get('/history/search/historyatasanpo',[TasklistAtasanPoController::class, 'SearchHistoryAtasanPO'])->name('menu-taskList-atasan-po.SearchHistoryAtasanPO');
        Route::get('/accept_atasan_selected_po', [TasklistAtasanPoController::class, 'accept_atasan_selected_po'])->name('menu-taskList-atasan-po.accept_atasan_selected_po');
        Route::get('/reject_atasan_selected', [TasklistAtasanPoController::class, 'reject_atasan_selected_po'])->name('menu-taskList-atasan-po.reject_atasan_selected_po');
        Route::get('/accept_atasan_selected_prchs', [TasklistAtasanPoController::class, 'accept_atasan_selected_prchs'])->name('menu-taskList-atasan-po.accept_atasan_selected_prchs');
        Route::get('/accept_atasan_po/{id}', [TasklistAtasanPoController::class, 'accept_atasan_po'])->name('menu-taskList-atasan-po-accept_atasan_po');
        Route::get('/history/sortPoBod',[TasklistAtasanPoController::class, 'SortHistoryPoBod'])->name('menu-taskList-atasan-po.SortHistoryPoBod');
    });

    // Menu Task list atasan Payment/Pendanaan
    Route::group(['prefix' => 'menu-taskList-atasan-payment'], function () {
        Route::get('/', [TasklistAtasanPaymentController::class, 'index'])->name('menu-taskList-atasan-payment.index');
        Route::get('/taskPySindu', [TasklistAtasanPaymentController::class, 'taskPySindu'])->name('menu-taskList-atasan-payment.taskPySindu');
        Route::get('/taskPyBayu', [TasklistAtasanPaymentController::class, 'taskPyBayu'])->name('menu-taskList-atasan-payment.taskPyBayu');
        Route::get('/taskPyVictor', [TasklistAtasanPaymentController::class, 'taskPyVictor'])->name('menu-taskList-atasan-payment.taskPyVictor');
        Route::get('/taskPyErwin', [TasklistAtasanPaymentController::class, 'taskPyErwin'])->name('menu-taskList-atasan-payment.taskPyErwin');
        Route::get('/taskPyTriyani', [TasklistAtasanPaymentController::class, 'taskPyTriyani'])->name('menu-taskList-atasan-payment.taskPyTriyani');
        Route::get('/history', [TasklistAtasanPaymentController::class, 'history'])->name('menu-taskList-atasan-payment.history');
        Route::get('/po_detail/{id}', [TasklistAtasanPaymentController::class, 'po_detail'])->name('menu-taskList-atasan-payment.po_detail');
        Route::get('/detail/{id}', [TasklistAtasanPaymentController::class, 'detail'])->name('menu-taskList-atasan-payment.detail');
        // Route::delete('/destroy/{id}', [TasklistAtasanPaymentController::class, 'destroy'])->name('menu-taskList-atasan-payment.destroy');
        Route::get('/approve_payment/{id}', [TasklistAtasanPaymentController::class, 'approve_payment'])->name('menu-taskList-atasan-payment-approve_payment');
        Route::get('/reject/{id}', [TasklistAtasanPaymentController::class, 'reject'])->name('menu-taskList-atasan-payment-reject');
        Route::get('/in/search/SearchTaskPYIn',[TasklistAtasanPaymentController::class, 'SearchTaskPYIn'])->name('menu-taskList-atasan-payment.SearchTaskPYIn');
        Route::get('/search/history/py',[TasklistAtasanPaymentController::class, 'SearchTaskPYOut'])->name('menu-taskList-atasan-payment.SearchTaskPYOut');
        Route::get('/history/search/SearchHistoryTaskPYOut',[TasklistAtasanPaymentController::class, 'SearchHistoryTaskPY'])->name('menu-taskList-atasan-payment.SearchHistoryTaskPY');
        Route::get('/approve_payment_py/{id}', [TasklistAtasanPaymentController::class, 'approve_payment_py'])->name('menu-taskList-atasan-payment-approve_payment_py');
        Route::get('/accept_atasan_selected_pymnt', [TasklistAtasanPaymentController::class, 'accept_atasan_selected_pymnt'])->name('menu-taskList-atasan-payment.accept_atasan_selected_pymnt');
        Route::get('/accept_atasan_selected_py', [TasklistAtasanPaymentController::class, 'accept_atasan_selected_py'])->name('menu-taskList-atasan-payment.accept_atasan_selected_py');
        Route::get('/reject_atasan_selected', [TasklistAtasanPaymentController::class, 'reject_atasan_selected'])->name('menu-taskList-atasan-payment.reject_atasan_selected_py');
        Route::get('/history/sortPyBod',[TasklistAtasanPaymentController::class, 'SortHistoryPyBod'])->name('menu-taskList-atasan-payment.SortHistoryPyBod');
    });
    //End Tasklist's Super User

    //Task List PO
    // Menu Task list po
    Route::group(['prefix' => 'menu-task-list'], function () {
        Route::get('/', [CategoryTaskListController::class, 'index'])->name('menu-task-list.index');
        Route::get('/filter',[CategoryTaskListController::class,'filterIndex'])->name('menu-task-list.filter');
        Route::get('/upcoming', [CategoryTaskListController::class, 'upComing'])->name('menu-task-list.upComing');
        Route::get('/upcoming/detail/{id}',[CategoryTaskListController::class, 'upComingDetail'])->name('menu-task-list.upComing.detail');
        Route::get('/history', [CategoryTaskListController::class, 'history'])->name('menu-task-list.history');
        Route::get('/detail/{id}', [CategoryTaskListController::class, 'detail'])->name('menu-task-list.detail');
        // Route::delete('/destroy/{id}', [CategoryTaskListController::class, 'destroy'])->name('menu-task-list.destroy');
        Route::get('/accept/{id}', [CategoryTaskListController::class, 'accept'])->name('menu-task-list-accept');
        Route::post('/reject/{id}', [CategoryTaskListController::class, 'reject'])->name('menu-task-list-reject');
        Route::get('/search/upcoming',[CategoryTaskListController::class, 'SearchtaskUpComming'])->name('menu-task-list.SearchtaskUpComming');
        Route::get('/search/taskPOIn',[CategoryTaskListController::class, 'SearchtaskPOIn'])->name('menu-task-list.SearchtaskPOIn');
        Route::get('/out/search/taskPOOut',[CategoryTaskListController::class, 'SearchtaskPOOut'])->name('menu-task-list.SearchtaskPOOut');
        Route::get('/history/search',[CategoryTaskListController::class, 'SearchtaskPOHistory'])->name('menu-task-list.SearchtaskPOHistory');
        Route::get('/history/sort',[CategoryTaskListController::class, 'SortTaskPOHistory'])->name('menu-task-list.SortTaskPOHistory');
    });
    //End Task List po

    //Task List Finance
    // Menu Task list finance
    Route::group(['prefix' => 'menu-tasklist-finance'], function () {
        Route::get('/', [TaskListFinanceController::class, 'index'])->name('menu-tasklist-finance.index');
        Route::get('/out', [TaskListFinanceController::class, 'out'])->name('menu-tasklist-finance.out');
        Route::get('/history', [TaskListFinanceController::class, 'history'])->name('menu-tasklist-finance.history');
        Route::get('/detail/{id}', [TaskListFinanceController::class, 'detail'])->name('menu-tasklist-finance.detail');
        Route::get('/po_detail/{id}', [TaskListFinanceController::class, 'po_detail'])->name('menu-tasklist-finance.po_detail');
        // Route::delete('/destroy/{id}', [TaskListFinanceController::class, 'destroy'])->name('menu-tasklist-finance.destroy');
        Route::get('/approve/{id}', [TaskListFinanceController::class, 'approve'])->name('menu-tasklist-finance-approve');
        Route::get('/reject/{id}', [TaskListFinanceController::class, 'reject'])->name('menu-tasklist-finance-reject');
        Route::post('/approve_tpy/{id}', [TaskListFinanceController::class, 'approve_po'])->name('menu-tasklist-finance-approve_po');
        Route::post('/reject_tpy/{id}', [TaskListFinanceController::class, 'reject_po'])->name('menu-tasklist-finance-reject_po');
        Route::get('/search/task-finance',[TaskListFinanceController::class, 'SearchTaskFinance'])->name('menu-tasklist-finance.SearchTaskFinance');
        Route::get('/out/search/task-finance-Out',[TaskListFinanceController::class, 'SearchTaskFinanceOut'])->name('menu-tasklist-finance.SearchTaskFinanceOut');
        Route::get('/search/history-task-finance',[TaskListFinanceController::class, 'SearchHistoryTaskFinance'])->name('menu-tasklist-finance.SearchHistoryTaskFinance');
        Route::get('/history/sortFinance',[TaskListFinanceController::class, 'SortHistoryFinance'])->name('menu-tasklist-finance.SortHistoryTaskFinance');

    });
    //End Task List Finance

    // Menu Edit PR Purchase

    Route::get('/PrList',[CategoryPOController::class, 'EditPRPurchase'])->name('editPRPurchase');
    Route::get('/PrList/detail/{id}',[CategoryPOController::class, 'ShowPRPurchaseDetail'])->name('ShowPRPurchaseDetail');
    Route::get('/PrList/edit/{id}',[CategoryPOController::class, 'ShowEditPRPurchase'])->name('ShowEditPRPurchase');
    Route::post('/PrList/update/{id}',[CategoryPOController::class, 'UpdatePRPurchase'])->name('UpdatePRPurchase');
    Route::get('/Prlist/search',[CategoryPOController::class, 'SearchEditPRPurchase'])->name('PrList.search');
    // End Menu Edit PR Purchase


    // Menu Purchase Order
    Route::group(['prefix' => 'menu-purchase-order'], function () {
        Route::get('/', [CategoryPOController::class, 'index'])->name('menu-purchase-order.index');
        Route::get('/filter',[CategoryPOController::class, 'filterIndex'])->name('menu-purchase-order.filter');
        Route::get('/history', [CategoryPOController::class, 'history'])->name('menu-purchase-order.history');
        Route::get('/out', [CategoryPOController::class, 'out'])->name('menu-purchase-order.out');
        Route::get('/po_detail/{id}', [CategoryPOController::class, 'po_detail'])->name('menu-purchase-order.po_detail');
        Route::get('/detail/{id}', [CategoryPOController::class, 'detail'])->name('menu-purchase-order.detail');
        Route::get('/create/{id}', [CategoryPOController::class, 'create'])->name('menu-purchase-order.create');
        Route::post('/store/{id}', [CategoryPOController::class, 'store'])->name('menu-purchase-order.store');
        Route::post('/update/{id}', [CategoryPOController::class, 'update'])->name('menu-purchase-order.update');
        Route::get('/edit/{id}', [CategoryPOController::class, 'edit'])->name('menu-purchase-order.edit');
        // Route::delete('/destroy/{id}', [CategoryPOController::class, 'destroy'])->name('menu-purchase-order.destroy');
        Route::post('/check_po/{id}', [CategoryPOController::class, 'checkPO'])->name('menu-purchase-order-checkPO');
        Route::post('/check_po2/{id}', [CategoryPOController::class, 'checkPO2'])->name('menu-purchase-order-checkPO2');
        Route::post('/spk_base/{id}', [CategoryPOController::class, 'check_spk'])->name('menu-purchase-order-spk_base');
        Route::post('/spk_base_selected',[CategoryPOController::class, 'spk_selected_approve'])->name('menu-purchase-order.spk_selected_approve');
        Route::post('/spk_base2/{id}', [CategoryPOController::class, 'check_po_spk'])->name('menu-purchase-order-spk_base2');
        Route::get('/ajukan_dana/{id}', [CategoryPOController::class, 'ajukan_dana'])->name('menu-purchase-order-ajukan_dana');
        Route::get('/denied/{id}', [CategoryPOController::class, 'denied'])->name('menu-purchase-order-denied');
        Route::get('/search/po_in',[CategoryPOController::class, 'SearchPOIn'])->name('menu-purchase-order.SearchPOIn');
        Route::get('/out/search/po_out',[CategoryPOController::class, 'SearchPOOut'])->name('menu-purchase-order.SearchPOOut');
        Route::get('/history/search/HistoryPO',[CategoryPOController::class, 'SearchHistoryPO'])->name('menu-purchase-order.SearchHistoryPO');
        Route::delete('/deletePOAll/{id}', [CategoryPOController::class, 'deletePOAll'])->name('menu-purchase-order.deletePOAll');
        Route::get('/history/sortPO',[CategoryPOController::class, 'SortHistoryPO'])->name('menu-purchase-order.SortHistoryPO');
        Route::post('/get-data',[CategoryPOController::class, 'getVendorRekening'])->name('menu-purchase-order.getVendorRekening');
    });

    // Menu Pengajuan dana Purchase Order
    Route::group(['prefix' => 'payment_request'], function () {
        Route::get('/', [InvoicingController::class, 'index'])->name('payment_request.index');
        Route::get('/out', [InvoicingController::class, 'out'])->name('payment_request.out');
        Route::get('/history', [InvoicingController::class, 'history'])->name('payment_request.history');
        Route::get('/detail/{id}', [InvoicingController::class, 'detail'])->name('payment_request.detail');
        Route::get('/po_detail/{id}', [InvoicingController::class, 'po_detail'])->name('payment_request.po_detail');
        Route::get('/create/{id}', [InvoicingController::class, 'create'])->name('payment_request.create');
        Route::post('/store/{id}', [InvoicingController::class, 'store'])->name('payment_request.store');
        Route::post('/update/{id}', [InvoicingController::class, 'update'])->name('payment_request.update');
        Route::get('/edit/{id}', [InvoicingController::class, 'edit'])->name('payment_request.edit');
        Route::delete('/destroy/{id}', [InvoicingController::class, 'destroy'])->name('payment_request.destroy');
        Route::get('/ajukan_dana/{id}', [InvoicingController::class, 'ajukan_dana'])->name('payment_request-ajukan_dana');
        Route::get('/ajukan_dana_ppo/{id}', [InvoicingController::class, 'ajukan_dana_ppo'])->name('payment_request-ajukan_dana_ppo');
        Route::get('/denied/{id}', [InvoicingController::class, 'denied'])->name('payment_request-denied');
        Route::get('/search/paymentreq_in',[InvoicingController::class, 'SearchPaymentreq_in'])->name('payment_request.SearchPaymentreq_in');
        Route::get('/out/search/paymentreq_out',[InvoicingController::class, 'SearchPaymentreq_out'])->name('payment_request.SearchPaymentreq_out');
        Route::get('/history/search/paymentreq_history',[InvoicingController::class, 'SearchHistoryPaymentReq'])->name('payment_request.SearchHistoryPaymentReq');
        Route::get('/history/sortpyreq',[InvoicingController::class, 'SortHistoryPaymentReq'])->name('payment_request.SortHistoryPaymentReq');
        // SearchHistoryPaymentReq
    });
    // Menu Pengajuan dana
    Route::group(['prefix' => 'menu-pengajuan-dana'], function () {
        Route::get('/', [CategoryPDController::class, 'index'])->name('menu-pengajuan-dana.index');
        Route::get('/out', [CategoryPDController::class, 'out'])->name('menu-pengajuan-dana.out');
        Route::get('/history', [CategoryPDController::class, 'history'])->name('menu-pengajuan-dana.history');
        Route::get('/detail/{id}', [CategoryPDController::class, 'detail'])->name('menu-pengajuan-dana.detail');
        Route::get('/po_detail/{id}', [CategoryPDController::class, 'po_detail'])->name('menu-pengajuan-dana.po_detail');
        Route::get('/create/{id}', [CategoryPDController::class, 'create'])->name('menu-pengajuan-dana.create');
        Route::post('/store/{id}', [CategoryPDController::class, 'store'])->name('menu-pengajuan-dana.store');
        Route::delete('/destroy/{id}', [CategoryPDController::class, 'destroy'])->name('menu-pengajuan-dana.destroy');
        Route::post('/paid/{id}', [CategoryPDController::class, 'paid'])->name('menu-pengajuan-dana-paid');
        Route::post('/reject/{id}', [CategoryPDController::class, 'reject'])->name('menu-pengajuan-dana-reject');
        Route::post('/paid_pd/{id}', [CategoryPDController::class, 'paid_pd'])->name('menu-pengajuan-dana-paid_pd');
        Route::post('/reject_pd/{id}', [CategoryPDController::class, 'reject_pd'])->name('menu-pengajuan-dana-reject_pd');
        Route::get('/search/pd_in',[CategoryPDController::class, 'SearchPDIn'])->name('menu-pengajuan-dana.SearchPDIn');
        Route::get('/search/pd_out',[CategoryPDController::class, 'SearchPDOut'])->name('menu-pengajuan-dana.SearchPDOut');
        Route::get('/history/search',[CategoryPDController::class, 'SearchHistoryPD'])->name('menu-pengajuan-dana.SearchHistoryPD');
        Route::get('/history/sortPD',[CategoryPDController::class, 'SortHistoryPD'])->name('menu-pengajuan-dana.SortHistoryPD');
    });

    // Menu Pengiriman
    Route::group(['prefix' => 'delivery'], function () {
        Route::get('/', [DeliveryController::class, 'index'])->name('delivery.index');
        Route::get('/out', [DeliveryController::class, 'out'])->name('delivery.out');
        Route::get('/history', [DeliveryController::class, 'history'])->name('delivery.history');
        Route::get('/detail/{id}', [DeliveryController::class, 'detail'])->name('delivery.detail');
        Route::get('/po_detail/{id}', [DeliveryController::class, 'po_detail'])->name('delivery.po_detail');
        Route::get('/create/{id}', [DeliveryController::class, 'create'])->name('delivery.create');
        Route::post('/store/{id}', [DeliveryController::class, 'store'])->name('delivery.store');
        Route::get('/edit/{id}', [DeliveryController::class, 'edit'])->name('delivery.edit');
        Route::post('/update/{id}', [DeliveryController::class, 'update'])->name('delivery.update');
        Route::delete('/destroy/{id}', [DeliveryController::class, 'destroy'])->name('delivery.destroy');
        Route::get('/complete/{id}', [DeliveryController::class, 'complete'])->name('delivery-complete');
        Route::get('/denied/{id}', [DeliveryController::class, 'denied'])->name('delivery-denied');
        Route::get('/complete_2/{id}', [DeliveryController::class, 'complete_2'])->name('delivery-complete_2');
        Route::get('/denied_2/{id}', [DeliveryController::class, 'denied_2'])->name('delivery-denied_2');
        Route::get('/search/delivery_in',[DeliveryController::class, 'SearchDeliveryIn'])->name('delivery.SearchDeliveryIn');
        Route::get('/search/delivery_out',[DeliveryController::class, 'SearchDeliveryOut'])->name('delivery.SearchDeliveryOut');
        Route::get('/history/search/delivery',[DeliveryController::class, 'SearchHistoryDelivery'])->name('delivery.SearchHistoryDelivery');
        Route::get('/history/sortDelivery',[DeliveryController::class, 'SortHistoryDelivery'])->name('delivery.SortHistoryDelivery');
        Route::post('/statusDeliveryStore/{id}', [DeliveryController::class, 'deliverystatus'])->name('delivery.deliverystatus');
        Route::post('/startShippy/{id}', [DeliveryController::class, 'startShip'])->name('delivery.startShip');
        Route::post('/endShippy/{id}', [DeliveryController::class, 'endShip'])->name('delivery.endShip');
        // Route::post('/setBackShippy/{id}', [DeliveryController::class, 'setBackShippy'])->name('delivery.setBackShippy');
        // Route::get('/track-dhl',[DeliveryController::class, 'trackDHL'])->name('`delivery.trackDHL`');
        // Route::get('/track-fedex',[DeliveryController::class, 'trackFedex'])->name('delivery.trackFedex');
    });

     // Menu Check Purchase Order
     Route::group(['prefix' => 'check_po'], function () {
        Route::get('/', [CheckPOController::class, 'index'])->name('check_po.index');
        Route::get('/detail/{id}', [CheckPOController::class, 'detail'])->name('check_po.detail');
        Route::get('/po_detail/{id}', [CheckPOController::class, 'po_detail'])->name('check_po.po_detail');
        Route::delete('/destroy/{id}', [CheckPOController::class, 'destroy'])->name('check_po.destroy');
        Route::get('/ajukan_keatasan/{id}', [CheckPOController::class, 'ajukan_keatasan'])->name('check_po-ajukan_keatasan');
        Route::get('/ajukan_keatasan_po/{id}', [CheckPOController::class, 'ajukan_keatasan_po'])->name('check_po-ajukan_keatasan_po');
        Route::post('/reject/{id}', [CheckPOController::class, 'reject_po'])->name('check_po.reject_po');
        Route::get('/search/checkpo',[CheckPOController::class, 'SearchCheckPO'])->name('check_po.SearchCheckPO');
        Route::get('/history', [CheckPOController::class, 'history'])->name('check_po.history');
        Route::get('/history/search',[CheckPOController::class, 'SearchHistoryCheckPO'])->name('check_po.SearchHistoryCheckPO');
        Route::get('/history/sortCP',[CheckPOController::class, 'SortHistoryCheckPO'])->name('check_po.SortHistoryCheckPO');
    });

    // Menu PO SPK Base (Manager Purchase)
    Route::group(['prefix' => 'po_spk'], function () {
        Route::get('/', [CategoryPOController::class, 'index_spk'])->name('pospk.index');
        Route::get('/detail/{id}', [CategoryPOController::class, 'detailspk'])->name('pospk.detail');
        Route::get('/po_detail/{id}', [CategoryPOController::class, 'po_detail_spk'])->name('pospk.po_detail');
        Route::post('/approve/{id}', [CategoryPOController::class, 'approve_spk'])->name('pospk-approve');
        Route::post('/approve_po/{id}', [CategoryPOController::class, 'approve_po_spk'])->name('pospk-approve-po');
        Route::post('/reject/{id}', [CategoryPOController::class, 'reject_pr_spk'])->name('pospk.reject.pr');
        Route::post('/reject_po/{id}', [CategoryPOController::class, 'reject_po_spk'])->name('pospk.reject.po');
        Route::get('/search',[CategoryPOController::class, 'search_spk'])->name('pospk.search');
        Route::get('/history', [CategoryPOController::class, 'history_spk'])->name('pospk.history');
        Route::get('/search/history',[CategoryPOController::class, 'SearchHistorySpk'])->name('pospk.SearchHistorySpk');
        // Route::get('/history/sort',[CategoryPOController::class, 'SortHistorySpk'])->name('pospk.SortHistorySpk');
    });


    //admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/create-admin', [AdminController::class, 'create']);
    Route::get('/show-admin/{id}', [AdminController::class, 'show']);
    Route::post('/store-admin', [AdminController::class, 'store']);
    Route::get('/admin-edit/{id}', [AdminController::class, 'edit']);
    Route::post('/admin-update/{id}', [AdminController::class, 'update']);
    Route::get('/admin-destroy/{id}', [AdminController::class, 'destroy']);
    Route::get('/search/users',[AdminController::class, 'SearchUsers'])->name('admin.SearchUser');

    // add role
    Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    Route::get('/create-role', [RoleController::class, 'create']);
    Route::get('/show-role/{id}', [RoleController::class, 'show']);
    Route::post('/store-role', [RoleController::class, 'store']);
    Route::get('/role-edit/{id}', [RoleController::class, 'edit']);
    Route::post('/role-update/{id}', [RoleController::class, 'update']);
    Route::delete('/role-destroy/{id}', [RoleController::class, 'destroy']);
    Route::get('/search/roles',[RoleController::class, 'SearchRoles'])->name('role.SearchRoles');

    //Item DB Pengajuan Pembelian & PO
    Route::get('/pengajuan_pembelian', [PengajuanPembelianController::class, 'index'])->name('pengajuan_pembelian.index');
    Route::get('/export_excel/pengajuan_pembelian', [PengajuanPembelianController::class, 'export'])->name('export-item');
    Route::get('/export_excel/purchase_order', [PengajuanPembelianController::class, 'exportnew'])->name('export-item-new');
    Route::get('/search/itemppb',[PengajuanPembelianController::class, 'SearchItemPPB'])->name('SearchItemPPB');
    Route::get('/search/itempo',[PengajuanPembelianController::class, 'SearchItemPO'])->name('SearchItemPO');

    // add Item History
    Route::get('/item-history', [ItemHistoryController::class, 'index'])->name('item-history.index');
    Route::get('/create-item-history', [ItemHistoryController::class, 'create']);
    Route::get('/show-item-history/{id}', [ItemHistoryController::class, 'show']);
    Route::post('/store-item-history', [ItemHistoryController::class, 'store']);
    Route::get('/item-history-edit/{id}', [ItemHistoryController::class, 'edit']);
    Route::post('/item-history-update/{id}', [ItemHistoryController::class, 'update']);
    Route::get('/item-history-destroy/{id}', [ItemHistoryController::class, 'destroy']);
    Route::get('/search/item-historys',[ItemHistoryController::class, 'SearchRoles'])->name('item-history.SearchRoles');
    Route::post('/item-history/importExcel', [ItemHistoryController::class, 'importExcel'])->name('importExcel');



    //comment
    Route::post('/comment/store/{id}',[CommentController::class,'store'])->name('comment.store');
    Route::post('/comment/update/{id}',[CommentController::class,'update'])->name('comment.update');
    Route::post('/comment/is_read/{id}',[CommentController::class,'is_read'])->name('comment.is_reaad');
    Route::get('/comment/destroy/{id}',[CommentController::class,'destroy'])->name('comment.destroy');


    //Route excel
    Route::get('/export_excel/pengajuan_dana/{id}', [PengajuanDanaController::class, 'export'])->name('export-pd');
    Route::get('/export_excel/quotation/{id}', [QuotationController::class, 'export'])->name('export-qt');
    Route::get('/export_excel/purchase_order/{id}', [PurchaseOrderController::class, 'export'])->name('export-po');
    Route::get('/export_excel/pembelian_barang/{id}', [PembelianBarangController::class, 'export'])->name('export-pb');
    Route::get('/export_excel/perusahaan', [CategoryPTController::class, 'export'])->name('export-pt');
    Route::get('/export_excel/private_person', [CategoryPPController::class, 'export'])->name('export-pp');
    Route::get('/export_excel/ecommerce', [CategoryEcommerceController::class, 'export'])->name('export-ec');
    Route::get('/export_excel/pengajuan_pembelian/{id}', [CategoryPengajuanPembelianController::class, 'export'])->name('export-ppb');
    Route::get('/export_excel/barang', [DeliveryController::class, 'export'])->name('export-pembelian');
    Route::get('/export_excel/history_purchase', [CategoryPOController::class, 'export'])->name('export-historyPO');
    Route::post('/export_excel/spesific_project', [PurchaseOrderController::class, 'exportExcelSpesific'])->name('export-po-spesific');
    Route::get('/export/roles',[RoleController::class,'export'])->name('export-roles');



    Route::get('/timeline-deliver/{id}',[DeliveryController::class, 'track_po'])->name('delivery.track_po');

    //Route Send Email Pengajuan
    Route::get('/send/{id}',[NotifPengajuanController::class, 'index']);

    //Route Send Email Purchase Order
    Route::get('/send-purchase/{id}',[NotifPOController::class, 'index']);

    //Route Send Email payment
    Route::get('/send-payment/{id}',[NotifPaymentController::class, 'index']);


    //Route Export PDF
    Route::get('/exportpdf/ppb/{id}', [CategoryPengajuanPembelianController::class, 'exportpdf'])->name('export_ppb.pdf');
    Route::get('/exportpdf/po/{id}', [PurchaseOrderController::class, 'exportpdf'])->name('export_po.pdf');
    Route::get('/exportpdf/po_id/{id}', [PurchaseOrderController::class, 'exportpdf_poid'])->name('export_po_id.pdf');
    Route::get('/exportpdf/po_multi/{id}', [PurchaseOrderController::class, 'exportmultipdf'])->name('exportmultipo.pdf');
    Route::get('/exportpdf/pymnt/{id}', [CategoryPDController::class, 'exportpdf'])->name('export_py.pdf');
    Route::get('/exportpdf/pymnt_id/{id}', [CategoryPDController::class, 'exportpdf_pyid'])->name('export_py_id.pdf');
    Route::get('/exportpdf/pymnt_multi/{id}', [CategoryPDController::class, 'exportpdf_multi'])->name('export_py_multi.pdf');
    //End Route Export

    //Route Import Private Person
    Route::get('file-import-pp', [CategoryPPController::class, 'fileImportPP']);
    Route::post('file-import', [CategoryPPController::class, 'fileImport'])->name('file-import');

    //Route Import Perusahaan
    Route::get('file-import-pt', [CategoryPTController::class, 'fileImportPT']);
    Route::post('file-import-perusahaan', [CategoryPTController::class, 'fileImport'])->name('file-import');

    //Route Import Ecommerce
    Route::get('file-import-ec', [CategoryEcommerceController::class, 'fileImportEC']);
    Route::post('file-import-ecommerce', [CategoryEcommerceController::class, 'fileImport'])->name('file-import');

    //Route Import Project
    Route::get('file-import-rf', [ReferensiNamaProjectController::class, 'fileImportRF']);
    Route::post('file-import-project', [ReferensiNamaProjectController::class, 'fileImport'])->name('file-import');

    //Route Import Pengajuan
    Route::get('file-import-ppb', [DeliveryController::class, 'fileImportPPB']);
    Route::post('file-import-pengajuan', [DeliveryController::class, 'fileImport'])->name('file-import');

    Route::get('send-wa', [SendWaController::class,'send'])->name('send-wa');
    });

    // Route::get('/info',function(){
    //     $check = App\Models\Role::where('model_id', Auth::user()->id)->first();
    //     if($check->role_id == 3){
    //         phpinfo();
    //     }else {
    //         return redirect()->back();
    //     }
    // });

});

Auth::routes();

