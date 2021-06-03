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
Route::Resource('payments', 'UploadPaymentController');
Route::Resource('files', 'FileUploadController');
Route::get('viewRequests', 'ViewRequestController@index')->name('viewRequests');
Route::get('/viewRequestByStatus/{request_status}', 'ViewRequestController@viewRequestByStatus')->name('viewRequestByStatus');
Route::get('/filterRequest', 'ViewRequestController@filterRequest')->name('filterRequest');
Route::get('/viewFile/{filename}', 'ViewRequestController@showFile')->name('getFile');

//for messenger
Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create/{id}', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});


