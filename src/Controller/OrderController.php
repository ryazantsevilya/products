<?php

namespace App\Controller;

use App\Http\RequestInterface;
use App\Http\ResponseInterface;
use App\Repository\OrderRepository;
use App\Router\Attributes\Route;

class OrderController extends AbstractController
{
    private OrderRepository $orderRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();        
    }

    #[Route('/api/order' , 'GET')]
    public function getUserOrders(RequestInterface $request) : ResponseInterface
    {
        $userId = $request->getParameter('userId');

        if (!ctype_digit($userId))
        {
            return $this->validateError();
        }

        if (!$userId) {
            return $this->validateError();
        }

        $orders = $this->orderRepository->getUserOrders($userId);

        return $this->json($orders);
    }
}
