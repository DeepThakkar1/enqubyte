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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::view('/', 'landing.soon');

Route::get('/', 'LandingCotroller@index');
Route::get('/features', 'LandingCotroller@feature');
Route::get('/privacy-policy', 'LandingCotroller@privacy_policy');
Route::get('/terms-and-conditions', 'LandingCotroller@terms_services');
Route::get('/demo', 'LandingCotroller@demo');

Auth::routes(['verify' => true]);

Route::get('/users/email/{email}/available', 'UsersController@emailIsAvailable');
Route::get('/users/username/{username}/available', 'UsersController@usernameIsAvailable');
Route::post('/users/mode', 'UsersController@mode');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/stores', 'StoresController@index');
Route::post('/stores', 'StoresController@store');
Route::get('/stores/{store}', 'StoresController@show');
Route::post('/stores/{store}/delete', 'StoresController@destroy');
Route::post('/stores/{store}/update', 'StoresController@update');

Route::post('/stores/{store}/manager', 'ManagersController@store');
Route::post('/stores/{store}/manager/{manager}/update', 'ManagersController@update');
Route::post('/stores/{store}/manager/{manager}/delete', 'ManagersController@destroy');


/*Route::get('/managers', 'ManagersController@index');
Route::post('/managers', 'ManagersController@store');
*/
Route::get('/products', 'ProductsController@index');
Route::post('/products', 'ProductsController@store');
Route::get('/products/{product}', 'ProductsController@show');
Route::get('/products/{product}/get', 'ProductsController@get');
Route::post('/products/{product}/delete', 'ProductsController@destroy');
Route::post('/products/{product}/update', 'ProductsController@update');
Route::get('/productsexcel', 'ProductsController@exportToExcel');
Route::get('/productspdf', 'ProductsController@exportToPDF');
Route::get('/productscsv', 'ProductsController@exportToCSV');
Route::post('/stores/{store}/products/{product}/assign', 'StocksController@store');

Route::get('/employees', 'EmployeesController@index');
Route::post('/employees', 'EmployeesController@store');
Route::get('/employees/{employee}', 'EmployeesController@show');
Route::post('/employees/{employee}/delete', 'EmployeesController@destroy');
Route::post('/employees/{employee}/update', 'EmployeesController@update');
Route::get('/employees/email/{email}/available', 'EmployeesController@emailIsAvailable');
Route::get('/employeesexcel', 'EmployeesController@exportToExcel');
Route::get('/employeespdf', 'EmployeesController@exportToPDF');
Route::get('/employeescsv', 'EmployeesController@exportToCSV');

Route::get('/visitors', 'VisitorsController@index');
Route::post('/visitors', 'VisitorsController@store');
Route::get('/visitors/{visitor}', 'VisitorsController@show');
Route::post('/visitors/{visitor}/delete', 'VisitorsController@destroy');
Route::post('/visitors/{visitor}/update', 'VisitorsController@update');
Route::get('/visitors/email/{email}/available', 'VisitorsController@emailIsAvailable');
Route::get('/visitorsexcel', 'VisitorsController@exportToExcel');
Route::get('/visitorspdf', 'VisitorsController@exportToPDF');
Route::get('/visitorscsv', 'VisitorsController@exportToCSV');

Route::get('/customers', 'CustomersController@index');
Route::post('/customers', 'CustomersController@store');
Route::post('/customers/{visitor}/delete', 'CustomersController@destroy');
Route::post('/customers/{visitor}/update', 'CustomersController@update');
Route::get('/customers/{visitor}', 'CustomersController@show');
Route::get('/customers/email/{email}/available', 'CustomersController@emailIsAvailable');
Route::get('/customersexcel', 'CustomersController@exportToExcel');
Route::get('/customerspdf','CustomersController@exportToPDF');
Route::get('/customerscsv','CustomersController@exportToCSV');

Route::get('/enquiries', 'EnquiriesController@index');
Route::get('/enquiries/add', 'EnquiriesController@create');
Route::get('/enquiries/{enquiry}/edit', 'EnquiriesController@edit');
Route::post('/enquiries', 'EnquiriesController@store');
Route::get('/enquiries/{enquiry}', 'EnquiriesController@show');
Route::post('/enquiries/{enquiry}/delete', 'EnquiriesController@destroy');
Route::post('/enquiries/{enquiry}/update', 'EnquiriesController@update');
Route::get('/enquiries/{enquiry}/invoice', 'EnquiriesController@createInvoice');
Route::get('/enquiries/{enquiry}/cancel', 'EnquiriesController@cancel');
Route::get('/enquiries/{enquiry}/download','EnquiriesController@download');
Route::get('/enquiriesexcel', 'EnquiriesController@exportToExcel');
Route::get('/enquiriespdf','EnquiriesController@exportToPDF');
Route::get('/enquiriescsv','EnquiriesController@exportToCSV');
Route::post('/enquiries/{enquiry}/changefollowupdate', 'EnquiriesController@changefollowupdate');


Route::get('/sales/invoices', 'InvoicesController@index');
Route::get('/sales/invoices/add', 'InvoicesController@create');
Route::get('/sales/invoices/{invoice}/edit', 'InvoicesController@edit');
Route::post('/sales/invoices', 'InvoicesController@store');
Route::get('/sales/invoices/{invoice}', 'InvoicesController@show');
Route::get('/sales/invoices/{invoice}/download','InvoicesController@download');
Route::post('/sales/invoices/{invoice}/delete', 'InvoicesController@destroy');
Route::get('/sales/invoices/{invoice}/cancel', 'InvoicesController@cancel');
Route::get('/enquiries/{enquiry}/cancel', 'EnquiriesController@cancel');
Route::post('/sales/invoices/{invoice}/update', 'InvoicesController@update');
Route::get('/invoicesexcel', 'InvoicesController@exportToExcel');
Route::get('/invoicespdf', 'InvoicesController@exportToPDF');
Route::get('/invoicescsv', 'InvoicesController@exportToCSV');

Route::post('/sales/invoices/{invoice}/recordpayment', 'RecordPaymentsController@store');


Route::get('/vendors', 'VendorsController@index');
Route::post('/vendors', 'VendorsController@store');
Route::get('/vendors/{vendor}', 'VendorsController@show');
Route::post('/vendors/{vendor}/delete', 'VendorsController@destroy');
Route::post('/vendors/{vendor}/update', 'VendorsController@update');
Route::get('/vendors/email/{email}/available', 'VendorsController@emailIsAvailable');
Route::get('/vendorsexcel', 'VendorsController@exportToExcel');
Route::get('/vendorspdf', 'VendorsController@exportToPDF');
Route::get('/vendorscsv', 'VendorsController@exportToCSV');


Route::get('/purchases', 'PurchaseOrdersController@index');
Route::get('/purchases/add', 'PurchaseOrdersController@create');
Route::get('/purchases/{purchaseOrder}/edit', 'PurchaseOrdersController@edit');
Route::post('/purchases', 'PurchaseOrdersController@store');
Route::get('/purchases/{purchaseOrder}', 'PurchaseOrdersController@show');
Route::get('/purchases/{purchaseOrder}/download','PurchaseOrdersController@download');
Route::post('/purchases/{purchaseOrder}/delete', 'PurchaseOrdersController@destroy');
Route::post('/purchases/{purchaseOrder}/update', 'PurchaseOrdersController@update');
Route::get('/purchasesexcel', 'PurchaseOrdersController@exportToExcel');
Route::get('/purchasespdf', 'PurchaseOrdersController@exportToPDF');
Route::get('/purchasescsv', 'PurchaseOrdersController@exportToCSV');

Route::post('/purchases/{purchaseOrder}/recordpayment', 'PurchaseOrderRecordPaymentController@store');

Route::get('/taxes', 'TaxesController@index');
Route::post('/taxes', 'TaxesController@store');
Route::post('/taxes/{tax}/update', 'TaxesController@update');
Route::post('/taxes/{tax}/delete', 'TaxesController@destroy');
Route::post('/taxes/{tax}/get', 'TaxesController@get');
Route::get('/taxes/abbreviation/{abbreviation}/available', 'TaxesController@abbreviationIsAvailable');

Route::get('/incentives', 'IncentivesController@index');
Route::post('/incentives', 'IncentivesController@store');
Route::post('/incentives/{incentive}/update', 'IncentivesController@update');
Route::post('/incentives/{incentive}/delete', 'IncentivesController@destroy');
Route::get('/incentivesexcel', 'IncentivesController@exportToExcel');
Route::get('/incentivespdf', 'IncentivesController@exportToPDF');
Route::get('/incentivescsv', 'IncentivesController@exportToCSV');

Route::post('/incentives/{employee}/pay', 'IncentiveTransactions@store');

Route::get('/statements/customer', 'StatementsController@customer');
Route::get('/statements/customer/{customer}', 'StatementsController@customerShow');
Route::get('/statements/vendor', 'StatementsController@vendor');
Route::get('/statements/vendor/{vendor}', 'StatementsController@vendorShow');
Route::get('/statements/salesman', 'StatementsController@employee');
Route::get('/statements/salesman/{employee}', 'StatementsController@salesmanShow');
Route::get('/statements/product', 'StatementsController@product');
Route::get('/statements/product/{product}', 'StatementsController@productShow');
Route::get('/statements/profitandloss', 'StatementsController@profitandloss');
Route::get('/statements/cashaccount', 'StatementsController@cashaccount');
Route::get('/statements/monthly', 'StatementsController@monthly');

Route::get('/cashflowexcel', 'StatementsController@cashflowExcel');
Route::get('/cashflowpdf', 'StatementsController@cashflowPDF');
Route::get('/cashflowcsv', 'StatementsController@cashflowCSV');

Route::get('/customerstatementexcel', 'StatementsController@customerStatementExcel');
Route::get('/customerstatementpdf', 'StatementsController@customerStatementPDF');
Route::get('/customerstatementcsv', 'StatementsController@customerStatementCSV');
Route::get('/productstatementexcel', 'StatementsController@productStatementExcel');
Route::get('/productstatementpdf', 'StatementsController@productStatementPDF');
Route::get('/productstatementcsv', 'StatementsController@productStatementCSV');
Route::get('/vendorstatementexcel', 'StatementsController@vendorStatementExcel');
Route::get('/vendorstatementpdf', 'StatementsController@vendorStatementPDF');
Route::get('/vendorstatementcsv', 'StatementsController@vendorStatementCSV');
Route::get('/profitandlossexcel', 'StatementsController@profitandlossExcel');
Route::get('/profitandlosspdf', 'StatementsController@profitandlossPDF');
Route::get('/profitandlosscsv', 'StatementsController@profitandlossCSV');

Route::get('/settings', 'SettingsController@index');
Route::post('/settings/general/mode', 'SettingsController@changeMode');
Route::post('/settings/profile/update', 'SettingsController@updateProfile');
Route::post('/settings/security/changepassword', 'SettingsController@updatePassword');
Route::post('/settings/company/update', 'SettingsController@updateCompany');
Route::post('/settings/general/report', 'SettingsController@reportFrequency');
Route::post('/settings/general/taxmode', 'SettingsController@taxmode');


Route::get('/billing', 'PaymentsController@index');
Route::get('/subscription/cancel', 'PaymentsController@cancel');
Route::get('/subscription/renew', 'PaymentsController@renew');
Route::get('/subscription/terminate', 'PaymentsController@terminate');
Route::get('/billing/invoice/{transactionId}', 'PaymentsController@invoice');

Route::get('/reports', 'ReportsController@index');

Route::get('/payment/success/{payment_id?}/{request_id?}','PaymentsController@success');

Route::post(
    'instamojo/webhook',
    '\Lubusin\Mojo\Controllers\WebhookController@handleWebhook'
);

Route::get('reset', 'HomeController@reset');
Route::get('setup', 'HomeController@showSetup');
Route::post('setup', 'HomeController@setup');
Route::get('redirecting', 'PaymentsController@redirecting');
Route::get('subscribed', 'PaymentsController@subscribed');

Route::post('/requestdemo','RequestDemoController@store');

/*Route::domain('{username}.enqubyte.com')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
});*/

Route::get('/admin', 'Admin\LoginController@index');
Route::post('/admin/login', 'Admin\LoginController@login');
Route::get('/admin/logout', 'Admin\LoginController@logout');
Route::get('/admin/dashboard', 'Admin\DashboardController@index');
Route::get('/admin/users', 'Admin\UsersController@index');
