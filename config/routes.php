<?php

$routes = [
    'home' =>
        [
            'url' => '',
            'controller' => '\App\Controller\HomeController',
            'action' => 'index',
        ],
    'recette' =>
        [
            'url' => 'recette/{id}',
            'controller' => '\App\Controller\RecetteController',
            'action' => 'show',
        ],
    'admin' =>
        [
            'url' => 'admin',
            'controller' => '\App\Controller\AdminController',
            'action' => 'index',
        ],
];

return $routes;
