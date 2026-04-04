<?php

require_once "core/Router.php";

$router = new Router();

// route tanımları
$router->get('404', 'NotFoundController@NotFound');
$router->get('', 'HomeController@homePage');
$router->get('terms', 'TermsController@termsPage');
$router->get('register', 'RegisterController@registerPage');
$router->post('register', 'RegisterController@registerPost');
$router->get('login', 'LoginController@login');
$router->post('login', 'LoginController@loginPost');
$router->get('logout', 'LoginController@logout');

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

?>