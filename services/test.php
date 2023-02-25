<?php
/** @var TYPE_NAME $service */

/** @var TYPE_NAME $db */

if (!isset($data->token) || gettype($data->token) !== "string") {
    $response = [
        "message" => "token is required",
        "code" => 403
    ];
    $service->response($response, $response['code']);
    exit();
}

require_once('helpers.php');

$decoded = decodeJWT($data->token);
if ($decoded === false) {
    $response = [
        "message" => "token is invalid",
        "code" => 403
    ];
    $service->response($response, $response['code']);
    exit();
}

$userId = $decoded->user_id;

$response = [
    "message" => "ok",
    "data" => $db->select('users', 'id = ?', [$userId]),
    "code" => 200
];

$service->response($response, $response['code']);
