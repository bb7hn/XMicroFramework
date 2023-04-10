<?php
// IF YOU DON'T HAVE ANY SPECIFIC CASES EDITING THIS FILE IS NOt SUGGESTED

/** @var boolean $debugger */
/** @var string $dbHost */
/** @var string $dbName */
/** @var string $dbUser */

/** @var string $dbPassword */

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

    // check does body has service index
    if (!isset($data->service) || gettype($data->service) !== "string") {
        // if doesn't have handle requested url in router and set service or return "invalid service" response
        require_once "router.php";
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
    if(getenv('APP_ENV') === 'local'){
        header("Content-Type: text/plain");
        //If ENV iS noy dev(local) delete file after executed
        require_once 'setup.php';
        exit();
    }

    $response = [
        "message" => "Internal server error! Service unavailable.",
        "code" => 500
    ];
    $service->response($response, $response['code']);
    exit();
}
