<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/','EmployeeController@employee');
Route::post('employee','EmployeeController@store')->name('employee');
Route::get('employee','EmployeeController@index')->name('employee');
Route::put('employee/{id}','EmployeeController@update')->name('employee');
Route::delete('employee/{id}','EmployeeController@delete')->name('employee');
Route::get('employee/{id}/{status}','EmployeeController@disabled')->name('employee');
