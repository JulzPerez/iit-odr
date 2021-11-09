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
//Route::Resource('request', 'RequestController');
Route::Resource('requester', 'RequesterController');
Route::Resource('fees', 'FeesController');
Route::Resource('users', 'UserController');
//Route::Resource('assessments', 'AssessmentController');
//Route::Resource('payments', 'UploadPaymentController');
Route::Resource('files', 'FileUploadController');

Route::get('monitoring',['as' => 'monitoring', 'uses' => 'MonitoringController@index']);
Route::get('getStat',['as' => 'getStat', 'uses' => 'MonitoringController@getStat']);

//assessment
Route::group(['prefix' => 'assessment'], function () {
	Route::get('/', ['as' => 'getAssessment', 'uses' => 'AssessmentController@getAssessment']);
	

});

//Request
Route::group(['prefix' => 'request'], function () {
	Route::get('/', ['as' => 'request.index', 'uses' => 'RequestController@index']);
	Route::post('/', ['as' => 'request.store', 'uses' => 'RequestController@store']);
	Route::get('/create', ['as' => 'request.create', 'uses' => 'RequestController@create']);
    Route::post('/UpdatePages', ['as' => 'updatePages', 'uses' => 'RequestController@updatePages']);
    Route::get('/getAttachments/{id}', ['as' => 'getAttachments', 'uses' => 'RequestController@getAttachments']);
    Route::get('/downloadFile/{file}', ['as' => 'downloadFile', 'uses' => 'RequestController@downloadFile']);
});

//Request
/* Route::get('getRequestForAssessment', 'RequestController@getRequestForAssessment')->name('getRequestForAssessment');

Route::get('viewRequests', 'ViewRequestController@index')->name('viewRequests');
Route::get('/viewRequestPaymentStatus/{status}', 'ViewRequestController@viewPaymentStatus')->name('viewRequestPaymentStatus');
Route::get('/viewRequestByStatus/{request_status}', 'ViewRequestController@viewRequestByStatus')->name('viewRequestByStatus');
Route::get('/filterRequest', 'ViewRequestController@filterRequest')->name('filterRequest');
Route::get('/viewFile/{filename}', 'ViewRequestController@showFile')->name('getFile'); */

//for work assignment
Route::group(['prefix' => 'workAssignment'], function () {
    Route::get('/', ['as' => 'workAssignment', 'uses' => 'WorkAssignmentController@index']);
    Route::post('/', ['as' => 'workAssignment.store', 'uses' => 'WorkAssignmentController@store']);
    Route::get('assignments', ['as' => 'assignments', 'uses' => 'WorkAssignmentController@viewAssignments']);
    Route::post('complete/{id}', ['as' => 'workAssignment.complete', 'uses' => 'WorkAssignmentController@markCompleted']); 
    Route::post('release/{id}', ['as' => 'workAssignment.release', 'uses' => 'WorkAssignmentController@markReleased']);
});

//for payments
Route::group(['prefix' => 'payments'], function () {
    Route::get('/', ['as' => 'payments', 'uses' => 'UploadPaymentController@index']);
    Route::get('showUploadPaymentForm/{request_id}/{doc_name}', ['as' => 'showUploadPaymentForm', 'uses' => 'UploadPaymentController@showUploadPaymentForm']);
    Route::get('requestPayment/{id}', ['as' => 'payments.showRequestorPayments', 'uses' => 'UploadPaymentController@showRequestorPayments']);
    Route::post('/', ['as' => 'payments.store', 'uses' => 'UploadPaymentController@store']);
    Route::get('{id}', ['as' => 'payments.show', 'uses' => 'UploadPaymentController@show']);
    Route::post('verify/{id}', ['as' => 'payments.verify', 'uses' => 'UploadPaymentController@verifyPayment']);
});

//for messenger
Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create/{requestID}/{requestorID}', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('/{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('/{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});




