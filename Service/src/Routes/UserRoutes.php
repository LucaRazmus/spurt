<?php
\Segura\AppCore\Router\Router::Instance()
    ->addRoute(
        \Segura\AppCore\Router\Route::Factory()
            ->setRouterPattern("/login")
            ->setHttpMethod('GET')
            ->setCallback(\Spurt\Controllers\UserController::class . ':showLogin')
            ->setName("Show Login")
    )->addRoute(
        \Segura\AppCore\Router\Route::Factory()
            ->setRouterPattern("/logout")
            ->setHttpMethod('GET')
            ->setCallback(\Spurt\Controllers\UserController::class . ':showLogout')
            ->setName("Show Logout")
    );