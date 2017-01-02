<?php
$this->container[\Spurt\Services\CauseOrgasmLinkService::class] = function (Slim\Container $c) {
    return new \Spurt\Services\CauseOrgasmLinkService(
        // Related Objects.
        $c->get(\Spurt\TableGateways\CausesTableGateway::class),
        $c->get(\Spurt\TableGateways\OrgasmsTableGateway::class),
        // Remote Constraints.
        // Self TableGateway.
        $c->get(\Spurt\TableGateways\CauseOrgasmLinkTableGateway::class)
    );
};
$this->container[\Spurt\Services\CausesService::class] = function (Slim\Container $c) {
    return new \Spurt\Services\CausesService(
        // Related Objects.
        // Remote Constraints.
        // Self TableGateway.
        $c->get(\Spurt\TableGateways\CausesTableGateway::class)
    );
};
$this->container[\Spurt\Services\OrgasmsService::class] = function (Slim\Container $c) {
    return new \Spurt\Services\OrgasmsService(
        // Related Objects.
        $c->get(\Spurt\TableGateways\UsersTableGateway::class),
        // Remote Constraints.
        // Self TableGateway.
        $c->get(\Spurt\TableGateways\OrgasmsTableGateway::class)
    );
};
$this->container[\Spurt\Services\SessionsService::class] = function (Slim\Container $c) {
    return new \Spurt\Services\SessionsService(
        // Related Objects.
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


$this->container[\Spurt\TableGateways\CauseOrgasmLinkTableGateway::class] = function (Slim\Container $c) {
    return new \Spurt\TableGateways\CauseOrgasmLinkTableGateway(
        $c->get(\Spurt\TableGateways\CausesTableGateway::class),
        $c->get(\Spurt\TableGateways\OrgasmsTableGateway::class),
        $c->get('Faker'),
        $c->get('DatabaseInstance')
    );
};
$this->container[\Spurt\TableGateways\CausesTableGateway::class] = function (Slim\Container $c) {
    return new \Spurt\TableGateways\CausesTableGateway(
        $c->get('Faker'),
        $c->get('DatabaseInstance')
    );
};
$this->container[\Spurt\TableGateways\OrgasmsTableGateway::class] = function (Slim\Container $c) {
    return new \Spurt\TableGateways\OrgasmsTableGateway(
        $c->get(\Spurt\TableGateways\UsersTableGateway::class),
        $c->get('Faker'),
        $c->get('DatabaseInstance')
    );
};
$this->container[\Spurt\TableGateways\SessionsTableGateway::class] = function (Slim\Container $c) {
    return new \Spurt\TableGateways\SessionsTableGateway(
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

$this->container['CauseOrgasmLinkMockModel'] = function (Slim\Container $c) {
    /** @var Spurt\TableGateways\CauseOrgasmLinkTableGateway $CauseOrgasmLinkTableGateway */
    $CauseOrgasmLinkTableGateway = $c->get(\Spurt\TableGateways\CauseOrgasmLinkTableGateway::class);
    $newCauseOrgasmLinkObject = $CauseOrgasmLinkTableGateway->getNewMockModelInstance();
    return $newCauseOrgasmLinkObject;
};
$this->container['CausesMockModel'] = function (Slim\Container $c) {
    /** @var Spurt\TableGateways\CausesTableGateway $CausesTableGateway */
    $CausesTableGateway = $c->get(\Spurt\TableGateways\CausesTableGateway::class);
    $newCausesObject = $CausesTableGateway->getNewMockModelInstance();
    return $newCausesObject;
};
$this->container['OrgasmsMockModel'] = function (Slim\Container $c) {
    /** @var Spurt\TableGateways\OrgasmsTableGateway $OrgasmsTableGateway */
    $OrgasmsTableGateway = $c->get(\Spurt\TableGateways\OrgasmsTableGateway::class);
    $newOrgasmsObject = $OrgasmsTableGateway->getNewMockModelInstance();
    return $newOrgasmsObject;
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