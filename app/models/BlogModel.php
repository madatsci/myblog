<?php

namespace App\Models;

use App\Core\Model;
use App\Core\MyLogger;

/**
 * Class BlogModel
 * @package App\Models
 */
class BlogModel extends Model
{
    /**
     * Сохраняет новый пост в БД.
     * intro_text - короткий текст, который выводится под заголовком поста в списке постов.
     *
     * @param $title
     * @param $text
     * @return bool|\mysqli_result
     */
    public function createPost($title, $text)
    {
        try {
            $result = $this->db->insert($this->tableName, [
                'author' => $_SESSION['user[]']['id'],
                'title' => trim($title),
                'intro_text' => mb_substr(trim($text), 0, 500), // для простоты берем просто первые 500 символов
                'full_text' => $text,
                'create_date' => date('Y-m-d H:i:s'),
                'change_date' => date('Y-m-d H:i:s')
            ]);

            return $result;
        } catch (\Exception $e) {
            MyLogger::lg('An error occurred while creating a new post: ' . $e->getMessage(), 'Database error');
            return false;
        }
    }

    /**
     * Получает из БД все посты, отсортированные по дате добавления по убыванию.
     * 
     * @return array|bool
     */
    public function getAllSortDateDesc()
    {
        return $this->db->getAll($this->tableName, 'create_date', false);
    }
}