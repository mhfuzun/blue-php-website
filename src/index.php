<?php

require_once 'core/Router.php';

$router = new Router();

// route tanımları
$router->get('404', 'NotFoundController@NotFound');
$router->get('', 'HomeController@home');
$router->get('login', 'LoginController@login');
$router->post('login', 'LoginController@loginPost');

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

?>