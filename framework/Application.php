<?php

namespace Framework;

use Database\Database;

class Application
{
    public static Application $app;
    public static string $ROOT_DIR;
    public string $layout = 'main';
    public Database $db;
    public Controller $controller;
    public Request $request;
    public Response $response;
    public View $view;
    public Route $route;

    public function __construct($routeDir)
    {
        self::$app = $this;
        self::$ROOT_DIR = $routeDir;
        $this->db = new Database();
        $this->request = new Request();
        $this->response = new Response();
        $this->view = new View();
        $this->route = new Route($this->request, $this->response);
    }

    public function run()
    {
        try {
            echo $this->route->resolve();
        } catch (\Exception $e) {
            echo $this->route->renderView('_error', [
                'exception' => $e,
            ]);
        }
    }
}
