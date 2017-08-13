<?php

use App\Customer;
use App\System;
use App\Test;
use App\Mail\WeeklyUpdate;

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
Route::get('admin', 'PagesController@admin')->name('admin');

// USER ROUTES
Route::get('profile', 'UsersController@profile')->name('profile');
Route::get('changepassword', 'UsersController@changePasswordView')->name('change_password');
Route::post('changepassword', 'UsersController@changePassword');

// CUSTOMER ROUTES
Route::resource('customers', 'CustomersController', [
    'except' => ['create', 'edit']
]);

// SITE ROUTES
Route::post('customers/{customer}/sites', 'SitesController@store');
Route::resource('sites', 'SitesController', [
    'except' => ['create', 'store', 'edit']
]);

// SYSTEM ROUTES
Route::post('site/{site}/systems', 'SystemsController@store');
Route::resource('systems', 'SystemsController', [
    'except' => ['create', 'store', 'edit']
]);

Route::put('system/{system}/update_next_test_date', 'SystemsController@updateNextTestDate');
Route::put('system/{system}/nullify_next_test_date', 'SystemsController@nullifyNextTestDate');

Route::post('systems/{system}/document', 'Documents\SystemDocumentsController@store');
Route::get('systems/document/{document}', 'Documents\SystemDocumentsController@show');
Route::put('systems/document/{document}', 'Documents\SystemDocumentsController@update');
Route::delete('systems/document/{document}', 'Documents\SystemDocumentsController@destroy');

// SYSTEM TYPES ROUTES
Route::get('createsystemtype', 'SystemTypesController@create');
Route::post('createsystemtype', 'SystemTypesController@store');

// MANUFACTURER AND COMPONENT ROUTES
Route::post('manufacturers', 'ManufacturersController@store');
Route::get('manufacturers', 'ManufacturersController@index');
Route::get('manufacturer/{manufacturer}', 'ManufacturersController@show')->name('manufacturer_show');
Route::put('manufacturers/{manufacturer}', 'ManufacturersController@update');

Route::get('component/create', 'ComponentsController@create');
Route::post('component/store', 'ComponentsController@store');
Route::get('component/{component}', 'ComponentsController@show')->name('component_show');
Route::post('update_component_form', 'ComponentsController@getModelForAttachComponentModal');
Route::put('component/{component}', 'ComponentsController@update');
Route::post('system/{system}/component/attach', 'ComponentsController@attach');
Route::post('system/{system}/component/{attachedComponentPivotId}/detach', 'ComponentsController@detach');
Route::delete('components/{component}', 'ComponentsController@destroy');
Route::post('component/{component}/document', 'Documents\ComponentDocumentsController@store');
Route::get('components/document/{document}', 'Documents\ComponentDocumentsController@show');
Route::delete('components/document/{document}', 'Documents\ComponentDocumentsController@destroy');

// WORK ORDER ROUTES
// Route::get('workorders', 'WorkOrdersController@index');
// Route::get('workorders/create', 'WorkOrdersController@create');
// Route::post('workorders', 'WorkOrdersController@store');
// Route::get('workorders/{workOrder}', 'WorkOrdersController@show');
// Route::patch('workorders/{workOrder}', 'WorkOrdersController@update');

// TEST ROUTES
Route::get('tests/{test}', 'TestsController@show')->name('test_show');
Route::get('tests', 'TestsController@index')->name('tests');
Route::post('system/{system}/tests/store', 'TestsController@store');
Route::put('tests/{test}/update', 'TestsController@update');
Route::delete('tests/{test}/delete', 'TestsController@destroy');

Route::post('tests/search', 'TestsController@search');

Route::post('tests/{test}/deficiencies/store', 'DeficienciesController@store');
Route::delete('tests/{test}/deficiencies/{deficiency}/delete', 'DeficienciesController@destroy');
Route::put('tests/{test}/deficiencies/{deficiency}/update', 'DeficienciesController@update');

Route::post('tests/{test}/testnotes/store', 'TestnotesController@store');
Route::delete('tests/{test}/testnotes/{testnote}/delete', 'TestnotesController@destroy');
Route::put('tests/{test}/testnotes/{testnote}/update', 'TestnotesController@update');

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
