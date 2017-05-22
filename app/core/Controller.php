<?php

namespace App\Core;

/**
 * Class Controller
 * @package App\Core
 */
class Controller
{
    protected $model;
    protected $view;
    protected $config;

    public function __construct()
    {
        $this->view = new View();
        $this->config = new Config();
    }

    /**
     * Выводит в браузер шаблон с подставленными данными
     * 
     * @param string $tplName
     * @param array $data
     */
    public function render($tplName, array $data = [])
    {
        // Системное сообщение
        $data['alert'] = isset($_SESSION['flash']) ? $_SESSION['flash'] : '';
        unset($_SESSION['flash']);

        // Панель пользователя
        $data['user_panel'] = $this->getUserPanel();

        $data['header'] = $this->view->renderPartial($data, 'header');
        $data['footer'] = $this->view->renderPartial($data, 'footer');
        $data['content'] = $this->view->renderPartial($data, $tplName);

        $this->view->render($data, 'layout');
    }

    /**
     * Возвращает шаблон с подставленными данными в виде строки
     * 
     * @param string $tplName
     * @param array $data
     * @return string
     */
    public function getReplacedTemplate($tplName, array $data = [])
    {
        return $this->view->renderPartial($data, $tplName);
    }

    /**
     * Сохраняет в сессию системное сообщение вместе с шаблоном
     * 
     * @param string $type
     * @param string $message
     */
    public function setFlash($type, $message)
    {
        $alert = $this->getReplacedTemplate("alert_{$type}", [
            'text' => $message
        ]);
        $_SESSION['flash'] = $alert;
    }

    /**
     * Перенаправляет на указанный URL
     *
     * @param $url
     */
    public function redirect($url)
    {
        header("Location: {$url}");
        exit;
    }

    /**
     * Перенаправляет на предыдущую страницу
     */
    public function redirectBack()
    {
        $this->redirect($_SERVER['HTTP_REFERER']);
    }

    /**
     * Выводит страницу ошибки 404
     */
    public function page404()
    {
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');

        $this->render('page404', [
            'page_title' => 'Страница не существует'
        ]);
    }

    /**
     * Возвращает шаблон пользовательской панели
     *
     * @return string
     */
    private function getUserPanel()
    {
        $template = isset($_SESSION['user[]']) ? 'user_panel_authorized' : 'user_panel_unauthorized';

        return $this->getReplacedTemplate($template);
    }
}
