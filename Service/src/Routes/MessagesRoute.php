<?php

\Segura\AppCore\Router\Router::Instance()
    ->addRoute(
        \Segura\AppCore\Router\Route::Factory()
            ->setRouterPattern("/v1/messages")
            ->setHttpMethod('PUT')
            ->setCallback(\Spurt\Controllers\MessageController::class . ':sendMessage')
            ->setSDKFunction("sendMessage")
            ->setSDKClass("Messaging")
            ->setName("Send Message")
            ->addCallbackProperty('sessionKey')
            ->addCallbackProperty('characterUUID')
            ->addCallbackProperty('targetUUID')
            ->addCallbackProperty('message')
    )
    ->addRoute(
        \Segura\AppCore\Router\Route::Factory()
            ->setRouterPattern("/v1/messages")
            ->setHttpMethod('POST')
            ->setCallback(\Spurt\Controllers\MessageController::class . ':getMessages')
            ->setSDKFunction("getMessages")
            ->setSDKClass("Messaging")
            ->setName("Get Messages")
            ->addCallbackProperty('sessionKey')
    );