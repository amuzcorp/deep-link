<?php

use AmuzPackages\DeepLink\Http\Controllers\DeepLinkController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::controller(DeepLinkController::class)->group(function(Router $router){
    $router->get('/get/context/{shortLink?}', 'getContext')->name('get-context');
    $router->get('/{shortLink}', 'redirect')->name('short-link');
});

