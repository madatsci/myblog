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
    const INTRO_TEXT_LENGTH = 500;

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
                'intro_text' => mb_substr(trim($text), 0, self::INTRO_TEXT_LENGTH), // для простоты берем просто первые 500 символов
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
     * Получает из БД все посты с именем автора, отсортированные по дате добавления по убыванию.
     * 
     * @return array|bool
     */
    public function getAllSortDateDesc()
    {
        $sql = "SELECT `p`.*, `u`.`login` AS 'author' FROM `{$this->config->dbPrefix}{$this->tableName}` `p`" .
            " JOIN `{$this->config->dbPrefix}user` `u` ON `u`.`id` = `p`.`author`" .
            " ORDER BY `p`.`create_date` DESC";

        return $this->db->customQuery($sql);
    }

    /**
     * Получает из БД пост по указанному ID
     * 
     * @param $id
     * @return bool|array
     */
    public function getPostById($id)
    {
        $sql = "SELECT `p`.*, `p`.`author` AS 'author_id', `u`.`login` AS 'author'" .
            " FROM `{$this->config->dbPrefix}{$this->tableName}` `p`" .
            " JOIN `{$this->config->dbPrefix}user` `u` ON `u`.`id` = `p`.`author`" .
            " WHERE `p`.`id` = {$id}";

        return $this->db->customQuery($sql);
    }

    /**
     * Удаляет пост с указанным ID
     * 
     * @param $id
     */
    public function deletePostById($id)
    {
        $this->db->deleteOnID($this->tableName, $id);
    }

    /**
     * Обновляет пост с указанным ID в БД
     * 
     * @param $title
     * @param $text
     * @param $id
     * @return bool|\mysqli_result
     */
    public function updatePostById($title, $text, $id)
    {
        $newData = [
            'title' => $title,
            'full_text' => $text,
            'intro_text' => mb_substr($text, 0, self::INTRO_TEXT_LENGTH),
            'change_date' => date('Y-m-d H:i:s')
        ];
        
        try {
            $result = $this->db->updateOnId($this->tableName, $newData, $id);
            
            return $result;
        } catch (\Exception $e) {
            MyLogger::lg(
                'An error occurred while updating the post with ID = {$id}: ' . $e->getMessage(),
                'Database error'
            );
            
            return false;
        }
    }
}
