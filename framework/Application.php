<?php

namespace Framework;

use Database\Database;

class Application
{
    public static Application $app;
    public static string $ROOT_DIR;
    public Database $db;
    public Controller $controller;
    public Request $request;
    public Response $response;

    public function __construct()
    {
        self::$app = $this;
        $this->db = new Database();
        $this->request = new Request();
        $this->response = new Response();
    }

    public function run()
    {
        require_once '../resources/views/index.php';
    }
}
