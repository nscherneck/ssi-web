<?php

use App\Mail\WeeklyUpdate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// BASE NAV ROUTES
Route::get('/', 'PagesController@home')->name('home');
Route::get('customer', 'PagesController@customer')->name('customer');
Route::get('sales', 'PagesController@sales')->name('sales');
Route::get('engineering', 'PagesController@engineering')->name('engineering');
Route::get('installation', 'PagesController@installation')->name('installation');
Route::get('service', 'PagesController@service')->name('service');
Route::get('docs', 'PagesController@docs')->name('docs');
Route::get('fleet', 'PagesController@fleet')->name('fleet');
Route::get('team', 'PagesController@team')->name('team');
Route::get('admin', 'PagesController@admin')->name('admin');

// CUSTOMER ROUTES
Route::get('customers', 'CustomersController@index')->name('customers');
Route::get('customer/{customer}', 'CustomersController@show')->name('customer_show');
Route::get('customers/create', 'CustomersController@create');
Route::post('customers/create', 'CustomersController@store');
Route::put('customer/{customer}/update', 'CustomersController@update');
Route::delete('customer/{customer}/delete', 'CustomersController@destroy');

// SITE ROUTES
Route::get('/sites', 'SitesController@index');
Route::post('customer/{customer}/site/create', 'SitesController@create');
Route::get('customer/{customer}/addsite', 'SitesController@add');
Route::get('site/{site}', 'SitesController@show')->name('site_show');
Route::get('/site/{site}/edit', 'SitesController@edit');
Route::put('site/{site}/update', 'SitesController@update');
Route::delete('site/{site}/delete', 'SitesController@destroy');
Route::get('site/{site}/photo/create', 'PhotosController@createSitePhoto');

// SYSTEM ROUTES
Route::post('site/{site}/create', 'SystemsController@store');
Route::put('system/{system}/update', 'SystemsController@update');
Route::get('system/{system}', 'SystemsController@show')->name('system_show');
Route::delete('system/{system}/delete', 'SystemsController@destroy');
Route::get('createsystemtype', 'SystemTypesController@create');
Route::post('createsystemtype', 'SystemTypesController@store');
Route::put('system/{system}/next_test_date', 'SystemsController@updateNextTestDate');


// COMPONENT ROUTES
Route::get('createmanufacturer', 'ManufacturersController@create');
Route::get('createcomponent', 'ComponentsController@create_page');
Route::post('createcomponent', 'ComponentsController@create');
Route::get('component/{component}', 'ComponentsController@show')->name('component_show');
Route::get('system/{system}/addcomponent', 'ComponentsController@add');
Route::post('update_component_form', 'ComponentsController@update_component_form');
Route::put('component/{component}', 'ComponentsController@update');
Route::post('system/{system}/attachcomponent', 'ComponentsController@attach');
Route::post('system/{system}/component/{id}/detach', 'ComponentsController@detach');
Route::post('component/{component}/document', 'DocumentsController@storeComponentDocument');


// TEST ROUTES
Route::get('tests/{test}', 'TestsController@show')->name('test_show');;
Route::post('system/{system}/tests/store', 'TestsController@store');
Route::put('tests/{test}/update', 'TestsController@update');
Route::delete('tests/{test}/delete', 'TestsController@destroy');

Route::post('tests/{test}/deficiencies/store', 'DeficienciesController@store');
Route::delete('tests/{test}/deficiencies/{deficiency}/delete', 'DeficienciesController@destroy');
Route::put('tests/{test}/deficiencies/{deficiency}/update', 'DeficienciesController@update');

Route::post('tests/{test}/testnotes/store', 'TestnotesController@store');
Route::delete('tests/{test}/testnotes/{testnote}/delete', 'TestnotesController@destroy');
Route::put('tests/{test}/testnotes/{testnote}/update', 'TestnotesController@update');

Route::post('test/{test}/report/store', 'DocumentsController@storeTestReport');
Route::get('test/{test}/report/{document}', 'DocumentsController@showReport');
Route::delete('test/{test}/report/{document}', 'DocumentsController@destroyTestReport');
Route::put('test/{test}/report/{document}', 'DocumentsController@updateTestReport');

// PHOTO ROUTES
Route::get('system/{system}/photo/create', 'PhotosController@createSystemPhoto');
Route::post('system/{system}/photo/create', 'PhotosController@storeSystemPhoto');
Route::get('system/photo/{photo}', 'PhotosController@showSystemPhoto')->name('system_photo_show');;
Route::put('system/photo/{photo}', 'PhotosController@update');
Route::delete('system/{system}/photo/{photo}', 'PhotosController@destroy');

Route::put('system/{system}/photo/{photo}/rotateleft', 'PhotosController@rotateLeft');
Route::put('system/{system}/photo/{photo}/rotateright', 'PhotosController@rotateRight');


Route::get('/sendweekly', function () {
  Mail::to('nathan.scherneck@gmail.com')->send(new WeeklyUpdate);
  return view('customers.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
// Route::post('/register', 'HomeController@store');
// Route::get('login', function() {
//   return view('auth.login');
// });
