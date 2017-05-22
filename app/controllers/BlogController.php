<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\BlogModel;

/**
 * Class BlogController
 * @package App\Controllers
 */
class BlogController extends Controller
{
    /**
     * BlogController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new BlogModel('post');
    }

    /**
     * Публикация нового поста
     */
    public function createPostAction()
    {
        if (!isset($_SESSION['user[]'])) {
            $this->setFlash('error', 'Для публикации поста необходимо быть авторизованным!');
            $this->redirect($this->config->baseUrl);
        }

        if (!empty($_POST)) {
            $formData = array_map('htmlspecialchars', $_POST);

            if (empty($formData['title']) || empty($formData['text'])) {
                $this->setFlash('error', 'Все поля обязательны для заполнения!');
                $this->redirectBack();
            } else {
                $result = $this->model->createPost($formData['title'], $formData['text']);

                if ($result) {
                    $this->setFlash('success', 'Пост успешно опубликован');
                } else {
                    $this->setFlash('error', 'Во время сохранения данных произошла ошибка!');
                }

                $this->redirectBack();
            }
        }

        $this->render('create_post', [
            'page_title' => 'Создание нового поста'
        ]);
    }

    public function listAction()
    {
        $posts = $this->model->getAllSortDateDesc();
        $listTemplate = '';

        foreach ($posts as $post) {
            $listTemplate .= $this->getReplacedTemplate('post', $post);
        }

        $this->render('post_list', [
            'page_title' => 'Блог - последние записи',
            'post_list' => $listTemplate
        ]);
    }
}