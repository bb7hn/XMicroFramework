<?php
// YOU CAN CREATE YOUR HELPERS IN THIS FILE

/** @var TYPE_NAME $JWT_KEY */

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function createJWT(array $payload = []): string
{
    global $JWT_KEY;
    return JWT::encode($payload, $JWT_KEY, 'HS256');

}

function decodeJWT(string $token = ""): bool|stdClass
{
    global $JWT_KEY;
    try {
        return JWT::decode($token, new Key($JWT_KEY, 'HS256'));
    } catch (throwable $exception) {
        return false;
    }


    /*JWT::$leeway = 60; // $leeway in seconds
    $decoded = JWT::decode($jwt, new Key($key, 'HS256'));*/
}

