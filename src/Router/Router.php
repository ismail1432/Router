<?php

namespace App\Router;

use App\Tools\FactoryController;

class Router
{
    public function loadRoutes()
    {
        return require_once(APP_ROOT . '/config/routes.php');
    }

    public function run()
    {
        $callback = $this->routerMatch();

        $controllerResolver = new FactoryController();
        $controllerResolver->resolveController($callback['controller'], $callback['action'], $callback['params']);
    }

    public function getRegExep($path)
    {
        $urlRegexGenerator = new UrlRegexGenerator();

        return $urlRegexGenerator->getRegex($path);
    }

    public function routerMatch()
    {
        $routes = $this->loadRoutes();

        $url = $_SERVER['QUERY_STRING'];

        foreach ($routes as $route) {
            $patternAsRegex = $this->getRegExep($route['url']);
            if ($patternAsRegex) {
                // We've got a regex, let's parse a URL
                if (preg_match($patternAsRegex, $url, $matches)) {
                    // Get elements with string keys from matches
                    $params = array_intersect_key(
                        $matches,
                        array_flip(array_filter(array_keys($matches), 'is_string'))
                    );

                    return [
                        'controller' => $route['controller'],
                        'action' => $route['action'],
                        'params' => $params,
                    ];
                }
            }
        }

        throw new \Exception(sprintf("No route match %s", $url));
    }
}
