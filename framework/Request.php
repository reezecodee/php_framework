<?php

namespace Framework;

class Request
{
    private array $routeParams = [];

    public function getHttpMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGetMethod()
    {
        return $this->getHttpMethod() === 'get';
    }

    public function isPostMethod()
    {
        return $this->getHttpMethod() === 'post';
    }

    public function getUrl()
    {
        $path = $_SERVER['REQUEST_URI'];
        $position = strpos($path, '?');
        if ($position !== false) {
            $path = substr($path, 0, $position);
        }

        return $path;
    }

    public function getBody()
    {
        $data = [];
        if ($this->isGetMethod()) {
            foreach ($_GET as $key => $value) {
                $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->isPostMethod()) {
            foreach ($_POST as $key => $value) {
                $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $data;
    }

    public function setRouteParams($params)
    {
        $this->routeParams = $params;
        return $this;
    }

    public function getRouteParams()
    {
        return $this->routeParams;
    }

    public function getRouteParam($param, $default = null)
    {
        return $this->routeParams[$param] ?? $default;
    }
}
