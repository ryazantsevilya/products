<?php

namespace App\Controller;

use App\Http\Response;
use App\Http\ResponseInterface;

abstract class AbstractController 
{
    protected function json(mixed $value): ResponseInterface
    {
        header('Content-Type: application/json; charset=utf-8');
        
        $response = new Response();
        $response->setContent(json_encode(
            [
                'code' => 200,
                'data' => $value,
            ]
        ));

        return $response;
    }

    protected function validateError(string $message = 'Validation error'): ResponseInterface
    {
        return $this->json(
            [
                'code' => 400,
                'msg' =>$message,
            ]
        );
    }

    protected function fatalError(string $message = 'Fatal error'): ResponseInterface
    {
        return $this->json(
            [
                'code' => 500,
                'msg' =>$message,
            ]
        );
    }
}
