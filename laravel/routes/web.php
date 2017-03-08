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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('ajax','AjaxController@SetProcess');

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', 'HomeController@index');

    // Route Project
    Route::get('list_projects', 'ProjectsController@getAllProject');    
    Route::get('projects/addedit', 'ProjectsController@ListProjects');
    Route::post('projects/addedit','ProjectsController@ListProjects');
    
    // Route Project
    Route::get('list_supplier', 'SupplierController@getAllSupplier');
    Route::get('supplier/addedit', 'SupplierController@addEditSupplier');
    Route::post('supplier/addedit','SupplierController@addEditSupplier');

    // Route Channel
    Route::get('list_channel', 'ChannelController@getAllChannel');
    Route::get('channel/addedit', 'ChannelController@addEditChannel');
    Route::post('channel/addedit','ChannelController@addEditChannel');
    
    //Jobs
    Route::get('list_job', 'JobController@getAllJob');
    Route::get('job/addedit', 'JobController@addEditJob');
    Route::post('job/addedit','JobController@addEditJob');
});
