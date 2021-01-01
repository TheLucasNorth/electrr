<?php

use App\Http\Controllers\MailgunController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Mailgun Routes
|--------------------------------------------------------------------------
|
| Routes used for Mailgun tracking integration are listed here. You can alter these to whatever you prefer.
| The webhooks you configure in Mailgun should exactly match the route names here, prefixed with mailgun.
| eg the delivered webhook URL would be {base url}/mailgun/delivered.
|
*/

Route::get('/delivered', [MailgunController::class, 'delivered']);
Route::get('/opened', [MailgunController::class, 'opened']);
Route::get('/bounced', [MailgunController::class, 'bounced']);
Route::get('/unsubscribed', [MailgunController::class, 'unsubscribed']);
Route::get('/complained', [MailgunController::class, 'complained']);
