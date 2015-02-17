<?php

$router = new Phalcon\Mvc\Router();

//ruta base
$router->add("/", [
    'controller' => 'index',
    'action' => 'index'
	])->setName("indice");
return $router;