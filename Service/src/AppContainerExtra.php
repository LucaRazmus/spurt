<?php

$this->container[\Spurt\Services\AuthService::class] = function (Slim\Container $c) {
    return new \Spurt\Services\AuthService(
        $c->get(\Spurt\Services\UsersService::class),
        $c->get(\Spurt\Services\SessionsService::class)
    );
};

$this->container[\Spurt\Controllers\AuthController::class] = function (\Slim\Container $c) {
    return new \Spurt\Controllers\AuthController(
        $c->get(\Spurt\Services\AuthService::class)
    );
};

$this->container[\Spurt\Controllers\CharacterController::class] = function (\Slim\Container $c) {
    return new \Spurt\Controllers\CharacterController(
        $c->get(\Spurt\Services\CharactersService::class)
    );
};

$this->container[\Spurt\Controllers\MessageController::class] = function (\Slim\Container $c) {
    return new \Spurt\Controllers\MessageController(
        $c->get(\Spurt\Services\SessionsService::class),
        $c->get(\Spurt\Services\CharactersService::class),
        $c->get(\Spurt\Services\MessagesService::class)
    );
};

$this->container[\Spurt\Controllers\UserController::class] = function (\Slim\Container $container){
    return new \Spurt\Controllers\UserController(
        $container->get(\Spurt\Services\UsersService::class),
        $container->get("view")
    );
};