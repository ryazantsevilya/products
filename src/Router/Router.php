<?php

namespace App\Router;

use App\Http\RequestInterface;
use App\Router\Attributes\Route;
use ReflectionClass;

class Router
{
    public function route(array $controllers, RequestInterface $request): array
    {
        foreach ($controllers as $controller) {
            $reflector = new ReflectionClass($controller);

            $methods = $reflector->getMethods();

            foreach ($methods as $method) {
                $attrs = $method->getAttributes();
    
                $requestUrl = $request->getUrl();
                $path = parse_url($requestUrl)['path'];

                $HTTPmethod = $request->getMethod();

                foreach ($attrs as $attribute) {
                    $attributeInstance = $attribute->newInstance();
                    if ($attributeInstance instanceof Route) {
                        if ($attributeInstance->getMethod() === $HTTPmethod && $attributeInstance->getUrl() === $path)
                        {
                            return ['class' => $reflector, 'method' => $method];
                        }
                    }
                }
            }
        }

        return [];
    }
}
