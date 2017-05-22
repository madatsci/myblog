<?php

namespace App\Controllers;

use App\Core\Controller;

/**
 * Class MainController
 * @package App\Controllers
 */
class MainController extends Controller
{
    public function indexAction()
    {
        $this->render('index', [
            'page_title' => 'Блог - главная страница'
        ]);
    }
}
