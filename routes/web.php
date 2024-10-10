<?php

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
use App\Http\Controllers\NetProfitController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomerageingController;
// Route::get('/', function () {
//     return view('master');
// });
// Route::get('/' , 'Controller@index' );

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('home','Controller');

Route::resource('users','UserController');

Route::resource('teachers','TeacherController');

Route::resource('save','Controller');

Route::post('submitdata','Controller@ClosingRecords')->name('submitdata');

Route::get('closing/closing_year','Controller@FetchAllData');

Route::get('obalance/fetch_o_balance','Controller@FetchObalance');

Route::resource('farmers','FarmerController');

Route::resource('directfarmers','DirectfarmerController');

Route::resource('guaranters','GuaranterController');

Route::resource('banks','BankController');

Route::resource('cashtransactions','CashtransactionController');

Route::resource('cashreceipts','CashreceiptController');

Route::resource('cashledgers','CashledgerController');

Route::resource('farmerledgers','FarmerledgerController');

Route::resource('supplierledgers','SupplierledgerController');

Route::resource('banktransactions','BanktransactionController');

Route::resource('bankreceipts','BankreceiptController');

Route::resource('bankledgers','BankledgerController');

Route::resource('expenseledgers','ExpenseledgerController');

Route::resource('liabilityledgers','LiabilityledgerController');

Route::resource('assetledgers','AssetledgerController');

Route::resource('cashinhands','CashinhandController');

Route::resource('expenses','ExpenseController');

Route::resource('incomes','IncomeController');

Route::resource('incomeledgers','IncomeledgerController');

Route::resource('exptypes','ExptypeController');

Route::resource('assettypes','AssetController');

Route::resource('accountsbks','AccountsbksController');

Route::resource('journalvouchers','JvController');

Route::resource('liabilities','LiabilitiesController');

Route::resource('prequisitions','PrequisitionController');

Route::resource('porders','PorderController');

Route::resource('gateinwards','GateinwardController');

Route::resource('mrreports','MrreportController');

Route::resource('scvaluations','ScvaluationController');

Route::resource('srequisitions','SrequisitionController');

Route::resource('squotations','SquotationController');

Route::resource('gateoutwards','GateoutwardController');

Route::resource('products','ProductController');

Route::resource('suppliers','SupplierController');

Route::resource('sales','SaleController');

Route::resource('salereturns','SalereturnController');

Route::resource('stocks','StockController');

Route::resource('prledgers','PrledgerController');

Route::resource('saleledgers','SaleledgerController');

Route::resource('grossprofits','GpController');

Route::resource('trialbalances','TrialbalanceController');
Route::get('closingbalance','TrialbalanceController@ClosingTrialBalance');

Route::resource('incomestatements','IncomestatementController');

Route::resource('srvrequisitions','SrvrequisitionController');

Route::resource('srvinvoices','SrvinvoiceController');

Route::resource('srvgrossprofits','SrvgrossprofitController');

Route::resource('companies','CompanyController');

Route::resource('cpersons','CpersonController');

Route::resource('quotes','QuotationController');

Route::resource('orders','OrdersController');

Route::resource('cnorders','CnordersController');
Route::resource('custom-aging','CustomerAgingController');
Route::post('aging-days','CustomerAgingController@AgingDaysSearch');


Route::get('searchaccount', ['as'=>'searchaccount','uses'=>'CashtransactionController@searchAccount']);

Route::get('searchteacher', ['as'=>'searchteacher','uses'=>'TeacherController@searchTeacher']);

Route::get('searchfarmer', ['as'=>'searchfarmer','uses'=>'JvController@searchFarmer']);

Route::get('searchjsupplier', ['as'=>'searchjsupplier','uses'=>'JvController@searchSupplier']);

Route::get('searchsupplier', ['as'=>'searchsupplier','uses'=>'PorderController@searchSupplier']);

Route::get('searchguaranter', ['as'=>'searchguaranter','uses'=>'FarmerController@searchGuaranter']);

Route::get('searchhead', ['as'=>'searchhead','uses'=>'CashtransactionController@searchHead']);

Route::get('searchvoucher', ['as'=>'searchvoucher','uses'=>'CashtransactionController@searchVoucher']);

Route::get('searchvoucherjournal', ['as'=>'searchvoucherjournal','uses'=>'JvController@searchVoucherjournal']);

Route::get('searchvouchercr', ['as'=>'searchvouchercr','uses'=>'CashreceiptController@searchVouchercr']);

Route::get('searchvoucherbk', ['as'=>'searchvoucherbk','uses'=>'BanktransactionController@searchVoucherbk']);

Route::get('searchvoucherbr', ['as'=>'searchvoucherbr','uses'=>'BankreceiptController@searchVoucherbr']);

Route::get('searchbankaccount', ['as'=>'searchbankaccount','uses'=>'BanktransactionController@searchAccount']);

Route::get('searchexpensehead', ['as'=>'searchexpensehead','uses'=>'BanktransactionController@searchHead']);

Route::get('searchbanks', ['as'=>'searchbanks','uses'=>'AccountsbksController@searchBank']);

Route::get('searchreqnumber', ['as'=>'searchreqnumber','uses'=>'PrequisitionController@searchReqnumber']);

Route::get('searchsreqnumber', ['as'=>'searchsreqnumber','uses'=>'SrequisitionController@searchSreqnumber']);

Route::get('searchlotnumber', ['as'=>'searchlotnumber','uses'=>'MrreportController@searchLotnumber']);

Route::get('searchstock', ['as'=>'searchstock','uses'=>'SquotationController@searchStock']);

Route::get('searchproducts', ['as'=>'searchproducts','uses'=>'SquotationController@action']);

Route::get('searchproductquote', ['as'=>'searchproductquote','uses'=>'QuotationController@searchproductQuote']);

Route::get('searchquote', ['as'=>'searchquote','uses'=>'QuotationController@searchQuote']);

Route::get('searchattn', ['as'=>'searchattn','uses'=>'QuotationController@searchAttn']);

Route::get('searchproductsindex', ['as'=>'searchproductsindex','uses'=>'Controller@action']);

Route::get('searchproduct', ['as'=>'searchproduct','uses'=>'PrequisitionController@searchProduct']);

Route::get('searchfrbalance', ['as'=>'searchfrbalance','uses'=>'FarmerController@searchFrbalance']);

Route::get('searchsrvreqnumber', ['as'=>'searchsrvreqnumber','uses'=>'SrvrequisitionController@searchSrvreqnumber']);

Route::get('searchcompany', ['as'=>'searchcompany','uses'=>'CpersonController@searchCompany']);

Route::get('searchsale', ['as'=>'searchsale','uses'=>'SrvinvoiceController@searchSale']);


Route::post('RangeCal', 'CashledgerController@rangeCal');

Route::post('BankRangeCal', 'BankledgerController@bankrangeCal');

Route::get('SavedPr', 'PrequisitionController@savedPr');

Route::get('FinalPr', 'PrequisitionController@finalPr');

Route::get('SavedSr', 'SrequisitionController@savedSr');

Route::get('FinalSr', 'SrequisitionController@finalSr');

Route::get('SavePr', 'PrequisitionController@savePr');

Route::get('SaveSr', 'SrequisitionController@saveSr');

Route::get('SavedPo', 'PorderController@savedPo');

Route::get('ImportPo', 'PorderController@importPo');

Route::get('ImportFinal', 'PorderController@importFinal');

Route::get('SavedGp', 'GateinwardController@savedGp');

Route::get('UnpostPr', 'PrequisitionController@unpostPr');

Route::get('UnpostSr', 'SrequisitionController@unpostSr');

Route::get('FinalRp', 'MrreportController@finalRp');

Route::get('FinalSq', 'SquotationController@finalSq');

Route::get('ShowImport/{id}', 'PorderController@showImport');

Route::get('PrintSc/{id}', 'ScvaluationController@printSc');

Route::get('Showsreport/{id}', 'QuotationController@showSreport');

Route::get('PrintSt', 'StockController@printSt');

Route::get('PrintMr/{id}', 'MrreportController@printMr');

Route::get('PrintGi/{id}', 'GateinwardController@printGi');

Route::get('PrintPo/{id}', 'PorderController@printPo');

Route::get('PrintPoimport/{id}', 'PorderController@printPoimport');

Route::get('PrintPr/{id}', 'PrequisitionController@printPr');

Route::get('PrintSq/{id}', 'SquotationController@printSq');

Route::get('PrintSqst/{id}', 'SquotationController@printSqst');

Route::get('PrintSr/{id}', 'SrequisitionController@printSr');

Route::get('PrintGo/{id}', 'GateoutwardController@printGo');

Route::get('PrintSl/{id}', 'SaleController@printSl');

Route::get('PrintFl/{id}', 'FarmerledgerController@printFl');

Route::get('PrintSpl/{id}', 'SupplierledgerController@printSpl');

Route::get('PrintPrl', 'PrledgerController@printPrl');

Route::get('PrintPrsl', 'SaleledgerController@printPrsl');

Route::get('PrintBl/{id}', 'BankledgerController@printBl');

Route::get('AddStock/{id}', 'ProductController@addStock');

Route::get('editPassword/{id}', 'UserController@editPassword');

Route::get('backup', 'Controller@backup');

Route::get('Salesprice', 'StockController@salesprice');

Route::get('Viewsalesprice', 'StockController@viewsalesprice');

Route::get('Expensereport', 'ExpenseledgerController@expensereport');

Route::get('year', 'AddYearController@index');
Route::get('year-create', 'AddYearController@create');
Route::post('year-save', 'AddYearController@save');

Route::post('/save-netprofit', [NetProfitController::class, 'saveData']);
Route::get('/customer-ageing', [CustomerageingController::class, 'index'])->name('customerageing.index');