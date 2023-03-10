<?php
// IF YOU DON'T HAVE ANY SPECIFIC CASES EDITING THIS FILE IS NOt SUGGESTED

/** @var TYPE_NAME $debugger */
/** @var TYPE_NAME $dbHost */
/** @var TYPE_NAME $dbName */
/** @var TYPE_NAME $dbUser */

/** @var TYPE_NAME $dbPassword */

use XMicro\MicroService;

require_once 'vendor/autoload.php';

// INIT CLASS
// NOTE THAT: IF DEBUGGER ENABLED YOU'LL SEE ONLY QUERIES.
require_once 'config.php';
$service = new MicroService($debugger ?? false);

// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json);
try {
    $db = $service->conn_mysql($dbHost, $dbName, $dbUser, $dbPassword);

    // DEFINE JWT SECRET KEY
    $JWT_KEY = ($db->select('config')['jwt_secret_key'] ?? 'temp_secret_key');

    // check does body have service index
    if (!isset($data->service) || gettype($data->service) !== "string") {
        $response = [
            "message" => "no service defined",
            "code" => 400
        ];
        $service->response($response, $response['code']);
        exit();
    }

    $file = __DIR__ . "/services/$data->service.php";

    if (!file_exists($file)) {
        $response = [
            "message" => "service does not exist => $data->service",
            "code" => 400
        ];
        $service->response($response, $response['code']);
        exit();
    }


    require_once($file);
} catch (throwable $exception) {
    $response = [
        "message" => "Internal server error! Service unavailable.",
        "code" => 500
    ];
    $service->response($response, $response['code']);
    exit();
}
