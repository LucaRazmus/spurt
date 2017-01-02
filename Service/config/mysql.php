<?php

$environment = array_merge($_ENV, $_SERVER);
ksort($environment);
$databaseConfiguration = [];
// Lets connect to a database

if(isset($environment['MYSQL_PORT'])) {
    $databaseConfigurationHost = parse_url($environment['MYSQL_PORT']);

    $databaseConfiguration['Default'] = array(
        'driver'   => 'Pdo_Mysql',
        'hostname' => $databaseConfigurationHost['host'],
        'port'     => $databaseConfigurationHost['port'],
        'username' => $environment['MYSQL_USER'],
        'password' => $environment['MYSQL_PASSWORD'],
        'database' => isset($environment['MYSQL_DATABASE'])?$environment['MYSQL_DATABASE'] : $environment['MYSQL_ENV_MYSQL_DATABASE'],
        'charset'  => "UTF8"
    );
}else{
    die("No DB config.");
}

return $databaseConfiguration;