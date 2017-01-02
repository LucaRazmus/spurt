<?php
\Segura\AppCore\Router\Router::Instance()
    ->addRoute(
        \Segura\AppCore\Router\Route::Factory()
            ->setRouterPattern("/dashboard")
            ->setHttpMethod('GET')
            ->setCallback(\Spurt\Controllers\DashboardController::class . ':showDashboard')
            ->setName("Show Dashboard")
    );