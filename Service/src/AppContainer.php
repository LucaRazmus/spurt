<?php
$this->container[\Spurt\Services\CharactersService::class] = function (Slim\Container $c) {
    return new \Spurt\Services\CharactersService(
        // Related Objects.
        $c->get(\Spurt\TableGateways\UsersTableGateway::class),
        // Remote Constraints.
        // Self TableGateway.
        $c->get(\Spurt\TableGateways\CharactersTableGateway::class)
    );
};
$this->container[\Spurt\Services\MessagesService::class] = function (Slim\Container $c) {
    return new \Spurt\Services\MessagesService(
        // Related Objects.
        $c->get(\Spurt\TableGateways\CharactersTableGateway::class),
        // Remote Constraints.
        // Self TableGateway.
        $c->get(\Spurt\TableGateways\MessagesTableGateway::class)
    );
};
$this->container[\Spurt\Services\SessionsService::class] = function (Slim\Container $c) {
    return new \Spurt\Services\SessionsService(
        // Related Objects.
        $c->get(\Spurt\TableGateways\UsersTableGateway::class),
        // Remote Constraints.
        // Self TableGateway.
        $c->get(\Spurt\TableGateways\SessionsTableGateway::class)
    );
};
$this->container[\Spurt\Services\UsersService::class] = function (Slim\Container $c) {
    return new \Spurt\Services\UsersService(
        // Related Objects.
        // Remote Constraints.
        // Self TableGateway.
        $c->get(\Spurt\TableGateways\UsersTableGateway::class)
    );
};


$this->container[\Spurt\TableGateways\CharactersTableGateway::class] = function (Slim\Container $c) {
    return new \Spurt\TableGateways\CharactersTableGateway(
        $c->get(\Spurt\TableGateways\UsersTableGateway::class),
        $c->get('Faker'),
        $c->get('DatabaseInstance')
    );
};
$this->container[\Spurt\TableGateways\MessagesTableGateway::class] = function (Slim\Container $c) {
    return new \Spurt\TableGateways\MessagesTableGateway(
        $c->get(\Spurt\TableGateways\CharactersTableGateway::class),
        $c->get('Faker'),
        $c->get('DatabaseInstance')
    );
};
$this->container[\Spurt\TableGateways\SessionsTableGateway::class] = function (Slim\Container $c) {
    return new \Spurt\TableGateways\SessionsTableGateway(
        $c->get(\Spurt\TableGateways\UsersTableGateway::class),
        $c->get('Faker'),
        $c->get('DatabaseInstance')
    );
};
$this->container[\Spurt\TableGateways\UsersTableGateway::class] = function (Slim\Container $c) {
    return new \Spurt\TableGateways\UsersTableGateway(
        $c->get('Faker'),
        $c->get('DatabaseInstance')
    );
};

$this->container['CharactersMockModel'] = function (Slim\Container $c) {
    /** @var Spurt\TableGateways\CharactersTableGateway $CharactersTableGateway */
    $CharactersTableGateway = $c->get(\Spurt\TableGateways\CharactersTableGateway::class);
    $newCharactersObject = $CharactersTableGateway->getNewMockModelInstance();
    return $newCharactersObject;
};
$this->container['MessagesMockModel'] = function (Slim\Container $c) {
    /** @var Spurt\TableGateways\MessagesTableGateway $MessagesTableGateway */
    $MessagesTableGateway = $c->get(\Spurt\TableGateways\MessagesTableGateway::class);
    $newMessagesObject = $MessagesTableGateway->getNewMockModelInstance();
    return $newMessagesObject;
};
$this->container['SessionsMockModel'] = function (Slim\Container $c) {
    /** @var Spurt\TableGateways\SessionsTableGateway $SessionsTableGateway */
    $SessionsTableGateway = $c->get(\Spurt\TableGateways\SessionsTableGateway::class);
    $newSessionsObject = $SessionsTableGateway->getNewMockModelInstance();
    return $newSessionsObject;
};
$this->container['UsersMockModel'] = function (Slim\Container $c) {
    /** @var Spurt\TableGateways\UsersTableGateway $UsersTableGateway */
    $UsersTableGateway = $c->get(\Spurt\TableGateways\UsersTableGateway::class);
    $newUsersObject = $UsersTableGateway->getNewMockModelInstance();
    return $newUsersObject;
};


return $this->container;