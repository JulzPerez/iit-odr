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

/* Route::get('/', function () {
    return view('home');
}); */ 

Auth::routes();

Route::get('/', 'HomeController@index');
Route::Resource('document', 'DocumentController');
Route::Resource('request', 'RequestController');
Route::Resource('requester', 'RequesterController');
Route::Resource('fees', 'FeesController');
Route::Resource('users', 'UserController');
Route::Resource('assessments', 'AssessmentController');
Route::get('viewRequests', 'ViewRequestController@index')->name('viewRequests');
Route::get('/viewRequestByStatus/{request_status}', 'ViewRequestController@viewRequestByStatus')->name('viewRequestByStatus');
Route::get('/filterRequest', 'ViewRequestController@filterRequest')->name('filterRequest');


