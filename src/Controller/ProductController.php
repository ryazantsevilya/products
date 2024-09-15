<?php

namespace App\Controller;

use App\Http\RequestInterface;
use App\Http\ResponseInterface;
use App\Router\Attributes\Route;
use App\Service\ProductService;

class ProductController extends AbstractController
{
    private ProductService $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }
    
    #[Route('/api/product' , 'POST')]
    public function createProduct(RequestInterface $request): ResponseInterface
    {
        $jsonData = $request->getJsonArray();

        if ($jsonData === null) {
            return $this->validateError();
        }

        foreach ($jsonData as $item) {
            if (!$this->validateProductData($item))
            {
                return $this->validateError();
            }
        }

        if ($this->productService->createProduct($jsonData)) {
            return $this->json('Create product success');
        } else {
            return $this->fatalError();
        }
    }

    private function validateProductData(array $jsonData) : bool
    {
        if (!isset($jsonData['title']) or !isset($jsonData['price'])) {
            return false;
        }

        $title = $jsonData['title'];
        $price = $jsonData['price'];

        if (!$title || strlen($title) > 255) {
            return false;
        }

        if (!is_numeric($price) || (float)$price < 0) {
            return false;
        }

        return true;
    }
}
