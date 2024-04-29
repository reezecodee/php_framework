<?php

namespace Framework;

abstract class Controller {
    public string $layout = 'main';
    public string $action = '';

    public function setLayout($layout): void
    {
        $this->layout = $layout;
    }

    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }
}