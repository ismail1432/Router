<?php

namespace App\Tools;

class FactoryController
{
    public function resolveController($controller, $action, $params = null)
    {
        if (!class_exists($controller)) {
            throw new \Exception(sprintf("The Class %s does not exists", $controller));
        }

        if (!method_exists($controller, $action)) {
            throw new \Exception(sprintf("The Method %s does not exists", $controller));
        }

        $method = new \ReflectionMethod($controller, $action);
        $expectedParams = $method->getNumberOfParameters();

        if(\count($params) !== $expectedParams) {
            throw new \InvalidArgumentException(sprintf("Class %s , Method %s expected %s arguments, %s given",
                $controller, $action, $expectedParams, count($params)));
        }
        
        $controller = new $controller();

        return \call_user_func_array([$controller, $action], $params);
    }
}
