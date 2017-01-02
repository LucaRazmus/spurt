<?php

$app->group("/v1", function () {
    $this->get("", \Segura\AppCore\Controllers\ApiListController::class . ':listAllRoutes')->setName("List all routes");
});

$app->get("/", function () {
    header("Location: /dashboard");
    exit;
});
