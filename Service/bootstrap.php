<?php
if (!defined("APP_ROOT")) {
    define("APP_START", microtime(true));
    define("APP_ROOT", __DIR__);
}

define("APP_NAME", "Spurt");
define("APP_CORE_NAME", "Spurt\\Spurt");

require_once("vendor/autoload.php");
require_once("config/env.php");
require_once("config/mysql.php");
$databaseConfiguration = require("config/mysql.php");


