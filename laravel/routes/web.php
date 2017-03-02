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
    Route::get('/home', 'HomeController@index');

    // Route Project
    Route::get('list_projects', 'ProjectsController@getAllProject');
    
    Route::get('projects/addedit', 'Projects\ProjectsController@ListProjects');
    Route::post('projects/addedit','Projects\ProjectsController@ListProjects');
// End Router Project
    
});
