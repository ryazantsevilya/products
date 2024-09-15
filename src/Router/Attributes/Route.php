<?php

namespace App\Router\Attributes;

use Attribute;

#[Attribute]
class Route 
{
    public function __construct(
       private string $url, 
       private string $method
    ) {
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getMethod(): string
    {
        return $this->method;
    }
}
