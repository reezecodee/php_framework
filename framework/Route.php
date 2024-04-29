<?php

namespace Framework;

class Route
{
    private Request $request;
    private Response $response;
    private static array $routeMap = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public static function get($url, $callback)
    {
        self::$routeMap['get'][$url] = $callback;
    }
    
    public static function post($url, $callback)
    {
        self::$routeMap['post'][$url] = $callback;
    }
}
