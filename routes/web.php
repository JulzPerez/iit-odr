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

/*  Route::get('/notice', function () {
    return view('notice');
}); */

Auth::routes(['verify' => true]);

Route::get('/', 'RequestController@index');
Route::Resource('document', 'DocumentController');
Route::Resource('request', 'RequestController');
Route::Resource('requester', 'RequesterController');
Route::Resource('fees', 'FeesController');
Route::Resource('users', 'UserController');
Route::Resource('assessments', 'AssessmentController');
//Route::Resource('payments', 'UploadPaymentController');
Route::Resource('files', 'FileUploadController');


//Request
Route::get('getRequestForAssessment', 'RequestController@getRequestForAssessment')->name('getRequestForAssessment');



Route::get('viewRequests', 'ViewRequestController@index')->name('viewRequests');
Route::get('/viewRequestPaymentStatus/{status}', 'ViewRequestController@viewPaymentStatus')->name('viewRequestPaymentStatus');
Route::get('/viewRequestByStatus/{request_status}', 'ViewRequestController@viewRequestByStatus')->name('viewRequestByStatus');
Route::get('/filterRequest', 'ViewRequestController@filterRequest')->name('filterRequest');
Route::get('/viewFile/{filename}', 'ViewRequestController@showFile')->name('getFile');

//for work assignment
Route::group(['prefix' => 'workAssignment'], function () {
    Route::get('/', ['as' => 'workAssignment', 'uses' => 'WorkAssignmentController@index']);
    Route::post('/', ['as' => 'workAssignment.store', 'uses' => 'WorkAssignmentController@store']);
    Route::get('/assignments', ['as' => 'workAssignment.assignments', 'uses' => 'WorkAssignmentController@viewAssignment']);
    /*Route::post('/', ['as' => 'payments.store', 'uses' => 'UploadPaymentController@store']);
    Route::get('{id}', ['as' => 'payments.show', 'uses' => 'UploadPaymentController@show']);
    Route::post('verifyPayment/{id}', ['as' => 'payments.verify', 'uses' => 'UploadPaymentController@verifyPayment']); */
});

//for payments
Route::group(['prefix' => 'payments'], function () {
    Route::get('/', ['as' => 'payments', 'uses' => 'UploadPaymentController@index']);
    Route::get('showUploadPaymentForm/{request_id}/{doc_name}', ['as' => 'showUploadPaymentForm', 'uses' => 'UploadPaymentController@showUploadPaymentForm']);
    Route::get('requestPayment/{id}', ['as' => 'payments.showRequestorPayments', 'uses' => 'UploadPaymentController@showRequestorPayments']);
    Route::post('/', ['as' => 'payments.store', 'uses' => 'UploadPaymentController@store']);
    Route::get('{id}', ['as' => 'payments.show', 'uses' => 'UploadPaymentController@show']);
    Route::post('verifyPayment/{id}', ['as' => 'payments.verify', 'uses' => 'UploadPaymentController@verifyPayment']);
});

//for messenger
Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create/{id}', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});



/* 
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});
 */
