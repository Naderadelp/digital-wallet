<?php

use App\Http\Controllers\IncomingWebhooksController;
use App\Http\Controllers\TransferController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Route::resource('incoming-webhooks', IncomingWebhooksController::class);
Route::post('/webhooks/{bank}', IncomingWebhooksController::class);
Route::post('/transfers/xml', [TransferController::class, '__invoke']);

