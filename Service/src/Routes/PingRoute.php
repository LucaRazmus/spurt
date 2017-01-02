<?php
\Segura\AppCore\Router\Router::Instance()
    ->addRoute(
        \Segura\AppCore\Router\Route::Factory()
            ->setRouterPattern("/v1/ping")
            ->setHttpMethod('GET')
            ->setCallback(\Segura\AppCore\Controllers\PingController::class . ":doPing")
            ->setSDKFunction("ping")
            ->setName("Ping!")
            ->setSDKClass("Meta")
    );