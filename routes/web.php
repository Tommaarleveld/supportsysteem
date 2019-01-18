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
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/admin/tickets', 'PagesController@adminTickets');

// Route to resources
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('tickets/claimTicket/{id}', 'TicketsController@claimTicket');
    Route::get('tickets/dropTicket/{id}', 'TicketsController@dropTicket');
    Route::get('tickets/markAsToReview/{id}', 'TicketsController@markAsToReview');
    Route::get('tickets/markAsDone/{id}', 'AdminTicketsController@markAsDone');
    Route::resource('tickets', 'TicketsController');
    Route::get('admin/tickets', 'AdminTicketsController@index');
  });

Route::get('/dashboard', 'DashboardController@index');



