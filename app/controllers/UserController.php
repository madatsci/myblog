<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyLogger;
use App\Models\UserModel;

/**
 * Class UserController
 * @package App\Controllers
 */
class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new UserModel();
    }

    /**
     * Регистрация нового пользователя
     */
    public function registerAction()
    {
        if (!empty($_POST)) {
            $formData = array_map('htmlspecialchars', $_POST);

            if ($formData['password'] !== $formData['confirm_password']) {
                $this->setFlash('error', 'Пароли не совпадают!');
            } else {
                $result = $this->model->createUser($formData['login'], $formData['email'], $formData['password']);
                if ($result) {
                    $this->setFlash('success', 'Вы успешно зарегистрировались!');
                    $this->redirect($this->config->baseUrl);
                } else {
                    $this->setFlash('error', 'Во время регистрации произошла ошибка!');
                }
            }

            $this->redirectBack();
        }

        $this->render('register', [
            'page_title' => 'Регистрация нового пользователя'
        ]);
    }

    /**
     * Авторизация пользователя
     */
    public function loginAction()
    {
        if (!empty($_POST)) {
            $formData = array_map('htmlspecialchars', $_POST);
            $user = $this->model->getUser($formData['login'], $formData['password']);

            if ($user) {
                $_SESSION['user[]'] = $user;
                $this->redirect($this->config->baseUrl);
                exit;
            } else {
                $this->setFlash('error', 'Неверные логин и/или пароль!');
                $this->redirectBack();
            }
        }

        $this->render('login', [
            'page_title' => 'Блог - Авторизация пользователя'
        ]);
    }

    /**
     * Выход пользователя
     */
    public function logoutAction()
    {
        unset($_SESSION['user[]']);
        $this->redirectBack();
    }
}