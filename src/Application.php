<?php

namespace App;

use App\Controller\FrontendController;
use App\Controller\OrderController;
use App\Controller\ProductController;
use App\DB\DB;
use App\DB\DBConnection;
use App\Http\Request;
use App\Http\RequestInterface;
use App\Http\ResponseInterface;
use App\Router\Router;

class Application 
{
    private static Application $instance;

    private Router $router;
    private RequestInterface $request;

    private CONST CONTROLLECRS = [
        OrderController::class,
        ProductController::class,
        FrontendController::class,
    ];

    private function __construct()
    {
        $this->router = new Router();
    }

    public function boot(): void
    {
        $this->initiDatabaseConnection();
        $this->initRequest();

        $route = $this->router->route(self::CONTROLLECRS, $this->request);

        if (!$route) {
            echo json_encode(['route not found']);
            return;
        }

        $controller = $route['class'];
        $method = $route['method'];
        
        $controller = $controller->newInstance();
        $parameters = $method->getParameters();

        $dependences = [];
        foreach ($parameters as $parameter) {
            if ($parameter->getType() == RequestInterface::class) {
                $dependences[$parameter->getName()] = $this->request;
            }
        }

        $response = $route['method']->invokeArgs($controller, $dependences);

        if ($response instanceof ResponseInterface) {
            ob_clean();
            echo $response->getContent();
        }
    }

    private function initiDatabaseConnection(): void
    {
        DB::setConnection(new DBConnection($_ENV['DB_URI'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']));
    }

    private function initRequest(): void
    {
        $requestUrl = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $content = file_get_contents('php://input');
        $request = new Request($requestMethod, $requestUrl, $content);

        $this->request = $request;
    }

    public static function getInstance(): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }
}
