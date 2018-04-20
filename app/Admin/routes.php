<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('/users', UserController::class);
    $router->resource('/products', ProductController::class);
    $router->resource('/carousels', CarouselController::class);
    $router->resource('/featureds',FeaturedController::class);
    $router->resource('/code',CodeController::class);
});
