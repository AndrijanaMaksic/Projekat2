<?php

require_once __DIR__.'/vendor/autoload.php';

use vebProjekat\controller\JewelryController;
use vebProjekat\controller\LoginController;
use vebProjekat\core\Application;
$app = new Application(dirname(__DIR__));

$app->router->get('/', 'home');
$app->router->get('/login','login');
$app->router->post('/login', [LoginController::class,'checkUser']);
$app->router->get('/logout', [LoginController::class,'logout']);
$app->router->get('/jewelry', [JewelryController::class,'getJewelryList']);

$app->run();

