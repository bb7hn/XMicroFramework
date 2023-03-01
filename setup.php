<?php
/** @var TYPE_NAME $dbHost */
/** @var TYPE_NAME $dbName */
/** @var TYPE_NAME $dbUser */

/** @var TYPE_NAME $dbPassword */

use XMicro\MicroService;

require_once 'vendor/autoload.php';
require_once 'config.php';
$service = new MicroService(true);

$db = $service->conn_mysql(DatabaseServer: $dbHost, DatabaseName: $dbName, DatabaseUser: $dbUser, DatabasePassword: $dbPassword);

// users table structure
$usersStructure = [
    'id' => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
    'email' => 'VARCHAR(255) NOT NULL',
    'username' => 'VARCHAR(255) NOT NULL',
    'password' => 'VARCHAR(255) NOT NULL'
];
$db->create('users', $usersStructure, true);

$users = [
    [
        'email' => 'test@test.com',
        'username' => 'test',
        'password' => '123123'
    ]
];
$db->insert('users', $users);

$configStructure = [
    'id' => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
    'jwt_secret_key' => 'TEXT',
    'maintenance' => 'BOOLEAN DEFAULT FALSE'
];
$db->create('config', $configStructure, true);

$defaultConfig = [
    [
        'jwt_secret_key' => uniqid('xMicro_', true),
        'maintenance' => 0
    ]
];
$db->insert('config', $defaultConfig);

unlink(__FILE__);
