<?php
// If YOU WANNA QUICK SETUP
// run=> `php -S 127.0.0.1:8000` on command line and go to http://127.0.0.1:8000/setup.php
// then delete the file
use XMicro\MicroService;

require_once 'vendor/autoload.php';
// INIT CLASS
// NOTE THAT: IF DEBUGGER ENABLED YOU'LL SEE ONLY QUERIES. NONE OF THEM WILL RUN
$service = new MicroService(true);
$db = $service->conn_mysql('localhost', 'x-micro', 'root', '');

// CREATE EXAMPLE
$usersStructure = [
    'id' => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
    'email' => 'VARCHAR(255)',
    'password' => 'VARCHAR(255)'
];

//$db->create('test', $structure,true); if you set third parameter true
//function will handle creating last 3 columns (created_at ,updated_at and deleted_at)
$db->create('users', $usersStructure, true);
