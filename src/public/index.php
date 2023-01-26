<?php
include "../vendor/autoload.php";
use \Core\Router;
session_start();
$router = new Router();
$router->run();

