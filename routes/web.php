<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\MenuController;
use App\Http\Controllers\admin\PlanController;
use App\Http\Controllers\admin\SubPlanController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\UserroleController;
use App\Http\Controllers\admin\SubscrptionController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\UserPrivillages;
use App\Http\Controllers\admin\CustomPlanController;
use App\Http\Controllers\admin\KitchenDisplayController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\CompanyController;
use App\Http\Controllers\admin\LockAccount;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\HomeController;

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
//     return view('auth.login');
// });
Route::get ('/',[LoginController::class, 'showLoginForm'])->name('login');
Route::get('lock',[LockAccount::class, 'lock'])->name('lock');
Route::post('unlock',[LockAccount::class, 'unlock'])->name('unlock');
Route::get('lock_site', [LockAccount::class, 'lock_site'])->name('lock_site');
Route::get('lock_logout', [LockAccount::class, 'lock_logout'])->name('lock_logout');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::group(['middleware' => ['prevent-back-history','lock']],function(){
Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('backup',[SettingController::class, 'backup'])->name('setting.backup');
Route::get('setting/empty-database',[SettingController::class, 'emptyDatabase'])->name('setting.emptyDatabase');
Route::get('clear-cache',[SettingController::class, 'clearCache'])->name('setting.clear-cache');

Route::resource('category-add', CategoryController::class);
Route::get('category-edit/{id}', [CategoryController::class,'edit'])->name('category_edit');
Route::post('category-update', [CategoryController::class,'update'])->name('category-update');
Route::get('category-delete/{id}',[CategoryController::class, 'updateStatus'])->name('category_delete');

Route::resource('menu-add', MenuController::class);
Route::get('menu-edit/{id}',[MenuController::class, 'edit'])->name('menu-edit');
Route::get('menu-delete/{id}',[MenuController::class, 'updateStatus'])->name('menu-delete');
Route::post('menu-update',[MenuController::class, 'update'])->name('menu-update');

Route::resource('plan-add', PlanController::class);
Route::resource('subplan', SubPlanController::class);
Route::post('subplan-udate',[SubPlanController::class, 'update'])->name('subplan-update');

Route::get('subplanstatuschange/{id}',[SubPlanController::class, 'updateStatus'])->name('subplan-status-change');
Route::resource('subplan-add', SubPlanController::class);
Route::get('planedit/{id}',[PlanController::class, 'edit'])->name('plan-edit');
Route::post('planupdate',[PlanController::class, 'update'])->name('plan-update');
Route::get('planstatuschange/{id}',[PlanController::class, 'updateStatus'])->name('plan-status-change');

Route::post('filter-sub-plan',[SubPlanController::class, 'filter_sub_plan'])->name('filter-sub-plan');
Route::post('product-filter-sub-plan',[SubPlanController::class, 'product_filter_sub_plan'])->name('product-filter-sub-plan');
Route::post('find_num_days',[PlanController::class, 'find_num_days'])->name('find_num_days');

Route::post('add-custom-plan',[CustomPlanController::class, 'store'])->name('add-custom-plan');
Route::get('addcustom-plan',[CustomPlanController::class, 'create'])->name('addcustom-plan');
Route::match(['get', 'post'], 'add-customplan',[CustomPlanController::class, 'create']);
Route::match(['get', 'post'], 'get_subplan_price',[SubPlanController::class, 'get_subplan_price'])->name('get_subplan_price');
Route::resource('viewsubscrption-list', SubscrptionController::class);
Route::get('/get-subscrption-data', [CustomPlanController::class, 'subscrption_data'])->name('get-subscrption-data');
Route::resource('customer-add', CustomerController::class);
Route::get('customer-edit/{id}',[CustomerController::class, 'edit'])->name('customer-edit');
Route::post('customerupdate',[CustomerController::class, 'update'])->name('customer-update');

Route::get('add-customer-downline/{id}',[CustomerController::class, 'add_customer_downline'])->name('add-customer-downline');
Route::post('store-customer-downline/{id}',[CustomerController::class, 'store_customer_downline'])->name('store-customer-downline');
Route::resource('user-role-add', UserroleController::class);
//profile
Route::get('profile_settings',[ProfileController::class, 'profile_settings']);
Route::post('update_profile',[ProfileController::class, 'update_profile'])->name('update_profile');
Route::post('update_password',[ProfileController::class, 'update_password'])->name('update_password');

Route::get('user-edit/{id}',[UserroleController::class, 'edit'])->name('user-edit');
Route::post('userupdate',[UserroleController::class, 'update'])->name('user-update');

Route::resource('user-add', UserController::class);
Route::get('roleedit/{id}',[UserroleController::class, 'edit'])->name('userrole-edit');
Route::post('roleupdate',[UserroleController::class, 'update'])->name('userrole-update');
Route::resource('user-privillages', UserPrivillages::class);
Route::match(['get','post'],'getmenus/{role_name?}', [UserPrivillages::class,'getmenus'])->name('getmenus');
Route::match(['get','post'],'assignroles/{id?}', [UserPrivillages::class,'storeassignroles'])->name('assignroles');
Route::post('user-privillages-update',[UserPrivillages::class, 'update'])->name('user-privillages-update');


Route::post('findcustomplan',[SubscrptionController::class, 'find_custom_plan'])->name('findcustomplan');
Route::post('add-bulk-menu',[SubscrptionController::class, 'add_bulk_menu'])->name('add-bulk-menu');
Route::get('view-custom-plan',[SubscrptionController::class, 'view_custom_plan'])->name('view-custom-plan');
Route::get('food-list/{id}',[SubscrptionController::class, 'food_list'])->name('food_list');
Route::post('food-list-ajax',[SubscrptionController::class, 'food_list_ajax'])->name('food-list-ajax');

Route::resource('product-add', ProductController::class);
Route::get('product-edit/{id}',[ProductController::class, 'edit'])->name('product-edit');
Route::post('product-update',[ProductController::class, 'update'])->name('product-update');

//kitchendisplay
Route::resource('kitchen-display', KitchenDisplayController::class);
Route::post('food-submit', [KitchenDisplayController::class,'store'])->name('food_submit');
Route::get('kitchenDisplay', [KitchenDisplayController::class,'index'])->name('kitchenDisplay');

//Order

Route::post('order-assign', [OrderController::class,'order_assign_driver'])->name('order_assign');
//Route::match(['get', 'post'], 'pending-order',[OrderController::class, 'pending_order'])->name('pending-order');
Route::get('pending-order', [OrderController::class,'pending_order'])->name('pending_order');
Route::get('all-order',[OrderController::class, 'all_order'])->name('all-order');

Route::match(['get', 'post'], 'assigned-order',[OrderController::class, 'assigned_order']);
Route::match(['get', 'post'], 'outofdelivery-order',[OrderController::class, 'outofdelivery_order']);
Route::match(['get', 'post'], 'delivery-view',[OrderController::class, 'delivery_view']);

Route::post('filter-order-by-date',[OrderController::class, 'filter_order_by_date'])->name('filter_order_by_date');
Route::post('filter-order-by-date-assigned',[OrderController::class, 'filter_order_by_date_assigned'])->name('filter_order_by_date_assigned');
Route::post('filter-order-by-date-report',[OrderController::class, 'filter_order_by_date_report'])->name('filter_order_by_date_report');
Route::post('filter-order-by-date-customer',[OrderController::class, 'filter_order_by_date_customer'])->name('filter_order_by_date_customer');
Route::post('filter-order-by-date-del',[OrderController::class, 'filter_order_by_date_del'])->name('filter_order_by_date_del');
Route::post('pending-order-filter',[OrderController::class, 'pending_order_filter'])->name('pending_order_filter');
Route::post('filter-order-by-date-delivery-view',[OrderController::class, 'filter_order_by_date_delivery_view'])->name('filter_order_by_date_delivery_view');
Route::post('filter-order-by-date-outof',[OrderController::class, 'filter_order_by_date_outof'])->name('filter_order_by_date_outof');

// Route::post('order-assign', [OrderController::class,'order_assign_driver'])->name('order_assign');
// Route::get('all-order',[OrderController::class, 'all_order'])->name('all-order');
// Route::post('filter-order-by-date',[OrderController::class, 'filter_order_by_date'])->name('filter_order_by_date');
// Route::get('filter-order-by-date',[OrderController::class, 'filter_order_by_date'])->name('filter_order_by_date');
// Route::post('filter-order-by-date-assigned',[OrderController::class, 'filter_order_by_date_assigned'])->name('filter_order_by_date_assigned');
// Route::post('filter-order-by-date-delivred',[OrderController::class, 'filter_order_by_date_delivred'])->name('filter_order_by_date_delivred');
// //Route::match(['get', 'post'], 'pending-order',[OrderController::class, 'pending_order'])->name('pending-order');
// Route::get('pending-order', [OrderController::class,'pending_order'])->name('pending_order');
// Route::match(['get', 'post'], 'assigned-order',[OrderController::class, 'assigned_order']);
// Route::match(['get', 'post'], 'outofdelivery-order',[OrderController::class, 'outofdelivery_order']);
// Route::match(['get', 'post'], 'delivery-view',[OrderController::class, 'delivery_view']);
//settings

Route::match(['get', 'post'], 'app_settings_update',[SettingController::class, 'app_settings_update']);
Route::match(['get', 'post'], 'business_settings',[SettingController::class, 'business_settings']);
Route::match(['get', 'post'], 'business_settings_update',[SettingController::class, 'business_settings_update']);
Route::get('companysettings',[CompanyController::class, 'index']);
Route::match(['get', 'post'], 'add_company_settings',[CompanyController::class, 'add_company_settings']);
Route::get('company_settings',[CompanyController::class, 'company_settings']);

// Report
Route::match(['get', 'post'], 'reports/allorder_report',[ReportController::class, 'allorder_report']);
Route::match(['get', 'post'], 'reports/areawise_report',[ReportController::class, 'areawise_report']);
Route::match(['get', 'post'], 'reports/assigned_report',[ReportController::class, 'assigned_report']);
Route::match(['get', 'post'], 'reports/delivery_report',[ReportController::class, 'delivery_report']);
Route::match(['get', 'post'], 'reports/driverwise_report',[ReportController::class, 'driverwise_report']);
Route::match(['get', 'post'], 'reports/out_of_delivery_report',[ReportController::class, 'out_of_delivery_report']);
Route::match(['get', 'post'], 'reports/paid_report',[ReportController::class, 'paid_report'])->name('paid_report');
Route::match(['get', 'post'], 'reports/pending_report',[ReportController::class, 'pending_report']);
Route::match(['get', 'post'], 'reports/sales_Report',[ReportController::class, 'sales_Report'])->name('sales_Report');
Route::match(['get', 'post'], 'reports/subcrption_report',[ReportController::class, 'subcrption_report'])->name('subscription_report');
Route::match(['get', 'post'], 'reports/customplan_report',[ReportController::class, 'customplan_report'])->name('customplan_report');
Route::match(['get', 'post'], 'reports/normalplan_report',[ReportController::class, 'normalplan_report'])->name('normalplan_report');
Route::match(['get', 'post'], 'reports/cancled_Report',[ReportController::class, 'cancled_Report']);
Route::match(['get', 'post'], 'reports/unpaid_report',[ReportController::class, 'unpaid_report'])->name('unpaid_report');
Route::match(['get', 'post'], 'reports/customer_report',[ReportController::class, 'customer_report']);
Route::match(['get', 'post'], 'reports/customer_depandreport',[ReportController::class, 'customer_depandreport']);
Route::match(['get', 'post'], 'reports/paused_Report',[ReportController::class, 'paused_Report']);
Route::match(['get', 'post'], 'reports/expiring_Report',[ReportController::class, 'expiring_Report'])->name('expiring_Report');
Route::match(['get', 'post'], 'reports/expired_report',[ReportController::class, 'expired_report'])->name('expired_report');
Route::match(['get', 'post'], 'reports/kitchen_itemwise',[ReportController::class, 'kitchen_itemwise']);
Route::match(['get', 'post'], 'reports/kitchen_report',[ReportController::class, 'kitchen_report']);
Route::match(['get', 'post'], 'reports/daily_Report',[ReportController::class, 'daily_Report']);
Route::post('filter-order-by-date-report',[ReportController::class, 'filter_order_by_date_report'])->name('filter_order_by_date_report');
Route::post('filter-order-by-date-customer',[ReportController::class, 'filter_order_by_date_customer'])->name('filter_order_by_date_customer');
Route::post('filter-order-by-date-del',[ReportController::class, 'filter_order_by_date_del'])->name('filter_order_by_date_del');



});