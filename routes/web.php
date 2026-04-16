<?php

use Illuminate\Support\Facades\Route;
use JonMierke\PaperLink\Http\Controllers\PaperLinkController;

Route::middleware(config('request-analytics.middleware.web'))
    ->get(config('request-analytics.route.pathname'), [RequestAnalyticsController::class, 'show'])
    ->name(config('request-analytics.route.name'));
