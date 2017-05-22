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
            $formData = array_map('trim', $formData);

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
            'page_title' => 'Создание нового поста',
            'action' => 'create',
            'title' => '',
            'full_text' => '',
            'id' => ''
        ]);
    }

    /**
     * Выводит список постов, отсортированный по дате создания по убыванию.
     */
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

    /**
     * Просмотр поста
     *
     * @param $id
     */
    public function postAction($id)
    {
        $post = $this->model->getPostById($id);
        
        if (empty($post)) {
            $this->page404();
        } else {
            $post = array_shift($post);

            // в базе, к сожалению, хранится только текст без разметки на абзацы
            $postTextParts = explode(PHP_EOL, $post['full_text']);
            $post['full_text'] = '<p>' . implode('</p><p>', $postTextParts) . '</p>';
        }

        $editLinksTpl = '';

        if (isset($_SESSION['user[]']['id']) && $_SESSION['user[]']['id'] === $post['author_id']) {
            $editLinksTpl = $this->getReplacedTemplate('post_edit_links', ['id' => $post['id']]);
        }

        $this->render(
            'post_view',
            array_merge([
                'page_title' => $post['title'],
                'edit_links' => $editLinksTpl
            ], $post)
        );
    }

    /**
     * Удаление поста
     *
     * @param $id
     */
    public function deletePostAction($id)
    {
        $this->model->deletePostById($id);
        $this->setFlash('success', 'Пост успешно удален');
        $this->redirect($this->config->baseUrl . 'blog/list');
    }

    /**
     * Редактирование поста
     *
     * @param $id
     */
    public function editPostAction($id)
    {
        $post = $this->model->getPostById($id);

        if (empty($post)) {
            $this->page404();
        } else {
            $post = array_shift($post);
        }

        if (!empty($_POST)) {
            $formData = array_map('htmlspecialchars', $_POST);
            $formData = array_map('trim', $formData);

            if (empty($formData['title']) || empty($formData['text'])) {
                $this->setFlash('error', 'Все поля обязательны для заполнения!');
                $this->redirectBack();
            } else {
                $result = $this->model->updatePostById($formData['title'], $formData['text'], $id);

                if ($result) {
                    $this->setFlash('success', 'Пост успешно обновлен');
                } else {
                    $this->setFlash('error', 'Во время сохранения данных произошла ошибка!');
                }

                $this->redirectBack();
            }
        }

        $this->render(
            'create_post',
            array_merge([
                'page_title' => 'Редактирование записи в блоге',
                'action' => 'edit'
            ], $post)
        );
    }
}
