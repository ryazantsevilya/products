<?php

namespace App\Http;

class Response implements ResponseInterface
{
    private string $content = '';

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}
