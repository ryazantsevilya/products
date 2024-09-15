<?php

namespace App\Http;

class Request implements RequestInterface
{
    private array $params = [];

    public function __construct(
        private string $requestMethod, 
        private string $url, 
        private string $content = '')
    {
        $this->parseGetParams();
    }

    public function getUrl(): string 
    {
        return $this->url;
    }

    public function getMethod(): string
    {
        return $this->requestMethod;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getJsonArray(): ?array
    {
        return json_decode($this->getContent(), true);
    }

    public function getParameter(string $name): ?string
    {
        if (isset($this->params[$name]))
        {
            return $this->params[$name];
        }
        
        return null;
    }

    private function parseGetParams(): void
    {
        $parse = parse_url($this->url)['query'];
        parse_str($parse, $this->params);
    }
}
