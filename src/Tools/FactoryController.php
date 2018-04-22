<?php

namespace App\Tools;

class FactoryController
{
    public function resolveController($controller, $action, $params = null)
    {
        if(!class_exists($controller)) {
            throw new \Exception(sprintf("The Class %s does not exists",$controller));
        }

        if(!method_exists($controller, $action)) {
            throw new \Exception(sprintf("The method %s does not exists",$controller));
        }

        $controller = new $controller();

        return $controller->$action();
    }
}
