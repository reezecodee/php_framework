<?php

namespace Framework;

class Route
{
    public $request;
    public $response;
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

    public function getRouteMap($method): array
    {
        return self::$routeMap[$method] ?? [];
    }

    public function getCallback()
    {
        $method = $this->request->getHttpMethod();
        $url = $this->request->getUrl();
        $url = trim($url, '/');

        $routes = $this->getRouteMap($method);
        $routeParams = false;

        foreach ($routes as $route => $callback) {
            $route = trim($route, '/');
            $routeNames = [];

            if (!$route) {
                continue;
            }

            if (preg_match_all('/\{(\w+)(:[^}]+)?}/', $route, $matches)) {
                $routeNames = $matches[1];
            }

            $routeRegex = "@^" . preg_replace_callback('/\{\w+(:([^}]+))?}/', fn ($m) => isset($m[2]) ? "({$m[2]})" : '(\w+)', $route) . "$@";

            if (preg_match_all($routeRegex, $url, $valueMatches)) {
                $values = [];
                for ($i = 1; $i < count($valueMatches); $i++) {
                    $values[] = $valueMatches[$i][0];
                }
                $routeParams = array_combine($routeNames, $values);

                $this->request->setRouteParams($routeParams);
                return $callback;
            }
        }

        return false;
    }

    public function resolve()
    {
        $method = $this->request->getHttpMethod();
        $url = $this->request->getUrl();
        $callback = self::$routeMap[$method][$url] ?? false;

        if (!$callback) {
            $callback = $this->getCallback();

            if ($callback === false) {
                echo "Error masbro";
            }
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            $dir = explode("/", $callback[0]);
            require_once Application::$ROOT_DIR . "/" . end($dir) .".php";
            $controller = new $callback[0]();
            $controller->action = $callback[1];
            Application::$app->controller = $controller;
            $callback[0] = $controller;
        }
        return call_user_func($callback, $this->request, $this->response);
    }

    public function renderView($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function renderViewOnly($view, $params = [])
    {
        return Application::$app->view->renderViewOnly($view, $params);
    }
}
