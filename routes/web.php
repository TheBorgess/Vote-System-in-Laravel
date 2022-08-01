<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EnqueteController;

use App\Http\Controllers\OptionController;

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

Route::get('/', [EnqueteController::class, 'index']);

Route::resource('enquetes', EnqueteController::class);

Route::resource('options', OptionController::class);

Route::get('/voteEnquetes/{id}', [OptionController::class, 'vote']);

Route::get('/reports', [EnqueteController::class, 'report']);

Route::get('/expireds', [EnqueteController::class, 'reportExpireds']);

Route::get('/inProgress', [EnqueteController::class, 'reportInProgress']);

Route::get('/notInitiated', [EnqueteController::class, 'reportNotInitiated']);

