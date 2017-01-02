<?php

\Segura\AppCore\Router\Router::Instance()
    ->addRoute(
        \Segura\AppCore\Router\Route::Factory()
            ->setRouterPattern("/v1/characters")
            ->setHttpMethod('GET')
            ->setCallback(\Spurt\Controllers\CharacterController::class . ':listCharacters')
            ->setSDKFunction("listCharacters")
            ->setSDKClass("Character")
            ->setName("Get All Character")
            ->setSDKTemplate('GET')
    )
    ->addRoute(
        \Segura\AppCore\Router\Route::Factory()
            ->setRouterPattern("/v1/characters/{uuid}")
            ->setHttpMethod('GET')
            ->setCallback(\Spurt\Controllers\CharacterController::class . ':getCharacter')
            ->setSDKFunction("getCharacter")
            ->setSDKClass("Character")
            ->setName("Get Character")
            ->setSDKTemplate('GET')
    );