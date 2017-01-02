<?php

\Segura\AppCore\Router\Router::Instance()
    ->addRoute(
        \Segura\AppCore\Router\Route::Factory()
            ->setRouterPattern("/v1/login")
            ->setHttpMethod('POST')
            ->setCallback(\Spurt\Controllers\AuthController::class . ':doLogin')
            ->setSDKFunction("doLogin")
            ->setSDKClass("Login")
            ->setName("Do Login")
            ->setCallbackProperties([
                ['name' => 'username'],
                ['name' => 'password'],
            ])
    );