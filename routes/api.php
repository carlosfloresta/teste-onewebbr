<?php

use CoffeeCode\Router\Router;
$router = new Router(URL_BASE);

/* Controllers */
$router->namespace("App\Controllers");

/* WEB - home */
$router->group(null);
$router->get("/", "WebController:home");

/* WEB - /trajeto/validar */
$router->get("/trajeto/validar/{estado}", "WebController:validar");

/* ERRORS */
$router->group("ops");
$router->get("/{errcode}", "WebController:error");

$router->dispatch();

if ($router->error()) {
    $router->redirect("/ops/{$router->error()}");
}
