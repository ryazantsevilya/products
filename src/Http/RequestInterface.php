<?php

namespace App\Http;

interface RequestInterface
{
    public function getUrl(): string;
    public function getContent(): string;
    public function getJsonArray(): ?array;
    public function getParameter(string $name): ?string;
    public function getMethod(): string;
}
