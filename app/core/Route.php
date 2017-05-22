<?php

namespace App\Core;

/**
 * Class Route
 */
class Route
{
    const DEFAULT_CONTROLLER_NAME = 'Main';
    const DEFAULT_ACTION_NAME = 'index';
    const CONTROLLER_POSTFIX = 'Controller';
    const MODEL_POSTFIX = 'Model';
    const ACTION_POSTFIX = 'Action';

    /**
     * Определяет контроллер и экшн на основе URL
     */
    public static function start()
    {
        $uriParts = explode('/', $_SERVER['REQUEST_URI']);

        // определяем класс контроллера и модели
        $rawControllerName = !empty($uriParts[1]) ? ucfirst($uriParts[1]) : self::DEFAULT_CONTROLLER_NAME;
        $controllerName = $rawControllerName . self::CONTROLLER_POSTFIX;
        $modelName = $rawControllerName . self::MODEL_POSTFIX;

        // определяем название метода
        $rawActionName = !empty($uriParts[2]) ? $uriParts[2] : self::DEFAULT_ACTION_NAME;

        if (false !== strpos($rawActionName, '-')) {
            $rawActionName = str_replace(' ', '', ucwords(str_replace('-', ' ', $rawActionName)));
        }

        $actionName = lcfirst($rawActionName) . self::ACTION_POSTFIX;

        // пути к файлам контроллера и модели
        $controllerFilePath = '../app/controllers/' . $controllerName . '.php';
        $modelFilePath = '../app/models/' . $modelName . '.php';

        // подключаем файл с классом контроллера, если таковой существует
        if (file_exists($controllerFilePath)) {
            require_once $controllerFilePath;
        } else {
            MyLogger::lg("$controllerFilePath", 'Controller file not found');
            self::error404();
        }

        // подключаем файл с классом модели, если он есть
        if (file_exists($modelFilePath)) {
            require_once $modelFilePath;
        }

        // инициализируем контроллер
        $controllerFullName = '\\App\\Controllers\\' . $controllerName;
        $controller = new $controllerFullName();

        // вызываем запрашиваемый метод контроллера, если он существует,
        // и передаем ему параметр, если он был получен из URL
        if (method_exists($controller, $actionName)) {
            if (isset($uriParts[3])) {
                MyLogger::lg(
                    "Controller: $controllerFullName, action: $actionName with param {$uriParts[3]}",
                    'Matched route'
                );
                $controller->$actionName($uriParts[3]);
            } else {
                MyLogger::lg("Controller: $controllerFullName, action: $actionName", 'Matched route');
                $controller->$actionName();
            }
        } else {
            MyLogger::lg("Method $actionName not found in $controllerFullName class", 'Method not found');
            self::error404();
        }
    }

    private static function error404()
    {
        $controller = new Controller();
        $controller->page404();
    }
}
