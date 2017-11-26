<?php

use App\Test;
use App\System;
use App\Customer;
use Illuminate\Http\Request;

// BASE NAV ROUTES
Route::get('/', 'PagesController@home')->name('home');
Route::get('customer', 'PagesController@customer')->name('customer');
Route::get('sales', 'PagesController@sales')->name('sales');
Route::get('engineering', 'PagesController@engineering')->name('engineering');
Route::get('jobs', 'PagesController@jobs')->name('jobs');
Route::get('service/home', 'PagesController@serviceHome')->name('service');
Route::get('service/metrics', 'PagesController@serviceMetrics')->name('servicemetrics');
Route::get('docs', 'PagesController@docs')->name('docs');
Route::get('fleet', 'PagesController@fleet')->name('fleet');
Route::get('team', 'PagesController@team')->name('team');
Route::get('admin', 'PagesController@admin')->middleware('auth', 'permission:Admin Dashboard')->name('admin');

Route::get('/tests/report/{test}', function (Test $test) {
    $basePath = base_path();
    $pdf = App::make('snappy.pdf.wrapper');
    $pdf = PDF::loadView('tests.pdf.show', ['test' => $test, 'basePath' => $basePath]);
    return $pdf->download('test-report.pdf');
});

Route::post('admin/users', function (Request $request) {
    dd($request->all());
});

// ADMIN DASHBOARD ROUTES
Route::resource('admin/branchoffices', 'Admin\BranchOfficeController');
Route::resource('admin/users', 'Admin\UserController');
Route::resource('admin/roles', 'Admin\RoleController');
Route::post('admin/roleuser/{role}', 'Admin\RoleUserController@store');
Route::post('admin/permissionrole/{role}', 'Admin\PermissionRoleController@store');
Route::resource('admin/permissions', 'Admin\PermissionController');
Route::resource('admin/employeetypes', 'Admin\EmployeeTypeController');
Route::resource('admin/sitecategories', 'Admin\SiteCategoryController');
Route::resource('admin/systemtypes', 'Admin\SystemTypeController');
Route::resource('admin/testtypes', 'Admin\TestTypeController');
Route::resource('admin/testresults', 'Admin\TestResultController');

// USER ROUTES
Route::get('profile', 'UsersController@profile')->name('profile');
Route::get('changepassword', 'UsersController@changePasswordView')->name('change_password');
Route::post('changepassword', 'UsersController@changePassword');

// CUSTOMER ROUTES
Route::get('customers/{customer}', 'CustomerController@show')
    ->middleware('auth', 'permission:View Customer');
Route::get('customers', 'CustomerController@index')
    ->middleware('auth', 'permission:View Customer')->name('customers.index');
Route::post('customers', 'CustomerController@store')
    ->middleware('auth', 'permission:Create Customer');
Route::put('customers/{customer}', 'CustomerController@update')
    ->middleware('auth', 'permission:Edit Customer');
Route::delete('customers/{customer}', 'CustomerController@destroy')
    ->middleware('auth', 'permission:Delete Customer');

// SITE ROUTES
Route::get('sites/{site}', 'SiteController@show')->middleware('auth', 'permission:View Site');
Route::get('sites', 'SiteController@index')->middleware('auth', 'permission:View Site')
    ->name('sites.index');
Route::post('customers/{customer}/sites', 'SiteController@store')->middleware('auth', 'permission:Create Site');
Route::put('sites/{site}', 'SiteController@update')->middleware('auth', 'permission:Edit Site');
Route::delete('sites/{site}', 'SiteController@destroy')->middleware('auth', 'permission:Delete Site');

// SYSTEM ROUTES
Route::get('systems/{system}', 'SystemController@show')->middleware('auth', 'permission:View System');
Route::get('systems', 'SystemController@index')->middleware('auth', 'permission:View System')
    ->name('systems.index');
Route::post('sites/{site}/systems', 'SystemController@store')->middleware('auth', 'permission:Create System');
Route::put('systems/{system}', 'SystemController@update')->middleware('auth', 'permission:Edit System');
Route::delete('systems/{system}', 'SystemController@destroy')->middleware('auth', 'permission:Delete System');

// SYSTEM NEXT TEST DATE ROUTES
Route::put('system/{system}/update_next_test_date', 'SystemController@updateNextTestDate');
Route::put('system/{system}/nullify_next_test_date', 'SystemController@nullifyNextTestDate');

// SYSTEM DOCUMENT ROUTES
Route::post('systems/{system}/document', 'Documents\SystemDocumentsController@store');
Route::get('systems/document/{document}', 'Documents\SystemDocumentsController@show');
Route::put('systems/document/{document}', 'Documents\SystemDocumentsController@update');
Route::delete('systems/document/{document}', 'Documents\SystemDocumentsController@destroy');

// SYSTEM TYPES ROUTES
Route::get('createsystemtype', 'SystemTypesController@create');
Route::post('createsystemtype', 'SystemTypesController@store');

// MANUFACTURER ROUTES
Route::post('manufacturers', 'ManufacturersController@store');
Route::get('manufacturers', 'ManufacturersController@index');
Route::get('manufacturer/{manufacturer}', 'ManufacturersController@show')->name('manufacturer_show');
Route::put('manufacturers/{manufacturer}', 'ManufacturersController@update');

// COMPONENT ROUTES
Route::post('manufacturers/{manufacturer}/component', 'ComponentController@store')
    ->middleware('auth', 'permission:Create Component');
Route::get('components/{component}', 'ComponentController@show')
    ->middleware('auth', 'permission:View Component')->name('component_show');
Route::put('component/{component}', 'ComponentController@update')
    ->middleware('auth', 'permission:Edit Component');
Route::delete('components/{component}', 'ComponentController@destroy')
    ->middleware('auth', 'permission:Delete Component');

// ATTACH & DETACH COMPONENTS
Route::post('update_component_form', 'ComponentController@getModelForAttachComponentModal')
    ->middleware('auth', 'permission:Attach Component');
Route::post('systems/{system}/component/attach', 'ComponentController@attach')
    ->middleware('auth', 'permission:Attach Component');
Route::post('systems/{system}/component/{attachedComponentPivotId}/detach', 'ComponentController@detach')
    ->middleware('auth', 'permission:Detach Component');

// COMPONENT DOCUMENTS
Route::post('component/{component}/document', 'Documents\ComponentDocumentsController@store');
Route::get('components/document/{document}', 'Documents\ComponentDocumentsController@show');
Route::delete('components/document/{document}', 'Documents\ComponentDocumentsController@destroy');

// WORK ORDER ROUTES
Route::resource('workorders', 'WorkOrdersController', [
    'except'    =>  ['show', 'update']
]);
Route::get('workorders/{workOrder}', 'WorkOrdersController@show');
Route::patch('workorders/{workOrder}', 'WorkOrdersController@update');

// TEST ROUTES
Route::get('tests/{test}', 'TestsController@show')->name('test_show');
Route::get('tests', 'TestsController@index')->name('tests');
Route::post('system/{system}/tests/store', 'TestsController@store');
Route::put('tests/{test}/update', 'TestsController@update');
Route::delete('tests/{test}/delete', 'TestsController@destroy');

Route::post('tests/search', 'TestsController@search');

Route::post('tests/{test}/deficiencies/store', 'TestDeficienciesController@store');
Route::delete('tests/{test}/deficiencies/{testDeficiency}/delete', 'TestDeficienciesController@destroy');
Route::put('tests/{test}/deficiencies/{testDeficiency}/update', 'TestDeficienciesController@update');

Route::post('tests/{test}/testnotes/store', 'TestNotesController@store');
Route::delete('tests/{test}/testnotes/{testNote}/delete', 'TestNotesController@destroy');
Route::put('tests/{test}/testnotes/{testNote}/update', 'TestNotesController@update');

Route::post('tests/{test}/document', 'Documents\TestDocumentsController@store');
Route::get('tests/document/{document}', 'Documents\TestDocumentsController@show');
Route::put('tests/document/{document}', 'Documents\TestDocumentsController@update');
Route::delete('tests/document/{document}', 'Documents\TestDocumentsController@destroy');

// PHOTO ROUTES
Route::post('systems/{system}/photos', 'Photos\SystemPhotosController@store');
Route::prefix('systems')->group(function () {
    Route::resource('photos', 'Photos\SystemPhotosController', [
        'except' => ['create', 'store', 'edit']
    ]);
});
Route::put('systems/photos/{photo}/rotateleft', 'Photos\SystemPhotosController@rotateLeft');
Route::put('systems/photos/{photo}/rotateright', 'Photos\SystemPhotosController@rotateRight');

// AJAX ROUTES
Route::post('get_sites', 'WorkOrdersController@getSites');


Auth::routes();

Route::get('/home', 'HomeController@index');
// Route::post('/register', 'HomeController@store');
// Route::get('login', function() {
//   return view('auth.login');
// });
