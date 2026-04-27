<?php

use Illuminate\Support\Facades\Route;
use JonMierke\PaperLink\Http\Controllers\PaperLinkRedirectController;

Route::middleware(config('request-analytics.middleware.web'))
    ->get(config('request-analytics.route.pathname'), [RequestAnalyticsController::class, 'show'])
    ->name(config('request-analytics.route.name'));

Route::get('/p/{slug}', [PaperLinkRedirectController::class, 'redirect'])
    ->name('paperlink.redirect')
    ->middleware('paperlink.web');