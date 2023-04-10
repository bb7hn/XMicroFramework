<?php
// YOU CAN DEFINE YOUR CONSTANT VARIABLES HERE AND ALSO CHANGE DEBUGGER MODE FROM HERE TO SEE RESPONSES
// SET DEFAULT TIME ZONE
date_default_timezone_set('Europe/Istanbul');
// Turn off all error reporting
error_reporting(0);
// DISABLE DEBUGGER
$debugger = false;
// DEFINE DATABASE CONFIG for master
$dbHost = 'master_db_host'; // usually localhost
$dbName = 'master_db_name';
$dbUser = 'master_user';
$dbPassword = 'master_password';
$SERVER_URL = '';

if(getenv('APP_ENV') === 'local'){
    $dbHost = getenv('DOCKER') === 'yes'?'db':'localhost';
    $dbName = 'xMicro';
    $dbUser = 'root';
    $dbPassword = '';
    $SERVER_URL = 'http://127.0.0.1:8000/';
}
