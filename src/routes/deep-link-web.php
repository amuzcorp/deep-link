<?php


use AmuzPackages\DeepLink\Http\Controllers\DeepLinkController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::controller(DeepLinkController::class)->group(function(Router $router){
   $router->post('/generate', 'store');
   $router->get('/l/{slug}', 'redirect')->name('get');
});
