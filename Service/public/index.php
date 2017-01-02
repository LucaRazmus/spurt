<?php

require_once(__DIR__ . "/../bootstrap.php");

\Spurt\Spurt::Instance()
    ->loadAllRoutes()
    ->getApp()
        ->run();
