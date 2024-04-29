<?php

namespace Framework;

class View
{
    public string $title = '';

    public static function render($view, array $params)
    {
    }

    public function renderView($view, array $params)
    {
        $layoutName = Application::$app->layout;
        if (Application::$app->controller) {
            $layoutName = Application::$app->controller->layout;
        }
        $viewContent = $this->renderViewOnly($view, $params);
        ob_start();
        include_once Application::$ROOT_DIR . "/resources/views/layouts/$layoutName.php";
        $layoutContent = ob_get_clean();
        return str_replace("{{ content }}", $viewContent, $layoutContent);
    }

    public function renderViewOnly($view, array $params)
    {
        foreach($params as $key => $value){
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/resources/views/$view.php";
        return ob_get_clean();
    }
}
