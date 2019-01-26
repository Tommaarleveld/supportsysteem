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

// Route to pages
Route::get('/', 'TicketsController@index');

// Route to resources
Auth::routes();

Route::group(['middleware' => 'is.admin'], function () {
    Route::get('tickets/markAsDone/{id}', 'AdminTicketsController@markAsDone');
    Route::delete('tickets/{ticket}', 'TicketsController@destroy');
    Route::get('tickets/dissaproveTicket/{id}', 'AdminTicketsController@dissaproveTicket');
    Route::resource('tickets', 'TicketsController');
    Route::get('admin/tickets', 'AdminTicketsController@index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('tickets/claimTicket/{id}', 'TicketsController@claimTicket');
    Route::get('tickets/dropTicket/{id}', 'TicketsController@dropTicket');
    Route::get('tickets/markAsToReview/{id}', 'TicketsController@markAsToReview');
    Route::resource('tickets', 'TicketsController')->only([
      'index', 'show'
    ]);
    Route::get('users/{id}/edit', 'UsersController@edit');
    Route::put('users/{id}/update', 'UsersController@update');
  });

Route::get('/dashboard', 'DashboardController@index');



