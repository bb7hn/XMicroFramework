<?php
/** @var MicroService $service */
use XMicro\MicroService;

$request_uri = $_SERVER['REQUEST_URI'];
if(getenv('DOCKER') === 'yes' && $request_uri==='/phpmyadmin'){
    header("Location: http://127.0.0.1:8080");
    die();
}
$routes_folder = __DIR__ . '/services'; // replace with the path to your routes folder

    $file = $routes_folder .str_replace('.php','',$request_uri).'.php';

    if(!file_exists($file)){
        $response = [
            "message" => ltrim($request_uri,'/')." service is not defined",
            "code" => 400,
        ];
        $service->response($response, $response['code']);
        exit();
    }
    require_once($file);
    exit();
