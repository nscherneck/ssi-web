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
Route::get('customers', 'CustomersController@index')->name('customers');
Route::get('customers/{customer}', 'CustomersController@show')->name('customer_show');
Route::get('customers/create', 'CustomersController@create');
Route::post('customers', 'CustomersController@store');
Route::put('customer/{customer}/update', 'CustomersController@update');
Route::delete('customer/{customer}/delete', 'CustomersController@destroy');

// SITE ROUTES
Route::get('/sites', 'SitesController@index')->name('sites');
Route::get('sites/{site}', 'SitesController@show')->name('site_show');
Route::post('customers/{customer}/site/create', 'SitesController@store');
Route::get('/site/{site}/edit', 'SitesController@edit');
Route::put('sites/{site}/update', 'SitesController@update');
Route::delete('site/{site}/delete', 'SitesController@destroy');
Route::get('site/{site}/photo/create', 'PhotosController@createSitePhoto');

// SYSTEM ROUTES
Route::post('site/{site}/create', 'SystemsController@store');
Route::get('systems/{system}', 'SystemsController@show')->name('system_show');
Route::get('systems', 'SystemsController@index')->name('system_index');
Route::put('systems/{system}/update', 'SystemsController@update');
Route::delete('system/{system}/delete', 'SystemsController@destroy');

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
Route::get('system/{system}/photo/create', 'PhotosController@createSystemPhoto');
Route::post('system/{system}/photo/create', 'PhotosController@storeSystemPhoto');
Route::get('system/photo/{photo}', 'PhotosController@showSystemPhoto')->name('system_photo_show');;
Route::put('system/photo/{photo}', 'PhotosController@update');
Route::delete('system/{system}/photo/{photo}', 'PhotosController@destroy');

Route::put('system/{system}/photo/{photo}/rotateleft', 'PhotosController@rotateLeft');
Route::put('system/{system}/photo/{photo}/rotateright', 'PhotosController@rotateRight');

// AJAX ROUTES
Route::post('get_sites', 'WorkOrdersController@getSites');


Auth::routes();

Route::get('/home', 'HomeController@index');
// Route::post('/register', 'HomeController@store');
// Route::get('login', function() {
//   return view('auth.login');
// });
