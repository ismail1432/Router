<?php

$routes = [
    'home' =>
        [
            'url' => '', //url to match
            'controller' => '\App\Controller\HomeController', //Controller to call
            'action' => 'index', //function in controller to call
        ],
    'recette' =>
        [
            'url' => 'recette/{id}/{slug}',
            'controller' => '\App\Controller\RecetteController',
            'action' => 'show',
            'params' => 'id', //params
            'params' => 'slug' //params
        ],
    'admin' =>
        [
            'url' => 'admin',
            'controller' => '\App\Controller\AdminController',
            'action' => 'index',
        ],
];

return $routes;
