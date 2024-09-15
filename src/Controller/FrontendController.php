<?php

namespace App\Controller;

use App\Http\Response;
use App\Http\ResponseInterface;
use App\Router\Attributes\Route;

class FrontendController extends AbstractController
{
    #[Route('/' , 'GET')]
    public function index(): ResponseInterface
    {
        $response = new Response();

        $content = file_get_contents(__DIR__ . '/../../frontend/index.html');
        $response->setContent($content);

        return $response;
    }
}