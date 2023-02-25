<?php
/** @var TYPE_NAME $service */

/** @var TYPE_NAME $db */

if (!isset($data->email) || gettype($data->email) !== "string") {
    $response = [
        "message" => "email is required",
        "code" => 400
    ];
    $service->response($response, $response['code']);
    exit();
}

if (!isset($data->password) || gettype($data->password) !== "string") {
    $response = [
        "message" => "password is required",
        "code" => 400
    ];
    $service->response($response, $response['code']);
    exit();
}

$email = $data->email;
$password = $data->password;

$user = $db->select('users', ["email = ?", "password = ?"], [$email, $password]);

if ($user === false) {
    $response = [
        "message" => "check your credentials",
        "code" => 401
    ];
    $service->response($response, $response['code']);
    exit();
}

$payload = [
    "created_at" => time(),
    "user_id" => $user["id"]
];
require_once('helpers.php');
$response = [
    "message" => "ok",
    "code" => 200,
    "token" => createJWT($payload)
];
$service->response($response, $response['code']);
