<?php
// use this file if you want to cache the twig file on prod
require_once __DIR__ . '/vendor/autoload.php';

use NiagahosterTest\Core\Router;
use NiagahosterTest\Controller\PriceController;
use NiagahosterTest\Controller\IndexController;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router($_SERVER);

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader, [
    'cache' => __DIR__ . '/twig-cache',
]);

$router->addRoute('/', 'GET', function () use ($twig) {
    $index = new IndexController($twig);
    $index->index();
});

$router->addRoute('/prices', 'GET', function () {
    $user = new PriceController($this->method, $this->params, $this->body);
    $user->find();
});

$router->addRoute('/prices/:id', 'GET', function () {
    $user = new PriceController($this->method, $this->params, $this->body);
    $user->params = $this->params;

    $user->findById();
});

$router->addRoute('/prices/:id', 'PUT', function () {
    $user = new PriceController($this->method, $this->params, $this->body);
    $user->params = $this->params;

    $user->update();
});

$router->addRoute('/prices/:id', 'DELETE', function () {
    $user = new PriceController($this->method, $this->params, $this->body);
    $user->params = $this->params;

    $user->delete();
});

$router->run();
