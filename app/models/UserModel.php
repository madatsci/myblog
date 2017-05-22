<?php

namespace App\Models;

use App\Core\Model;
use App\Core\MyLogger;

/**
 * Class UserModel
 * @package App\Core\Models
 */
class UserModel extends Model
{
    public function __construct()
    {
        parent::__construct('user');
    }

    /**
     * Сохраняет нового пользователя в БД
     *
     * @param $login
     * @param $email
     * @param $password
     * @return bool|\mysqli_result
     */
    public function createUser($login, $email, $password)
    {
        try {
            $encoded = md5($password);
            
            if (!$this->validator->validLogin($login) || !$this->validator->validHash($encoded)) {
                throw new \Exception('Invalid login on password hash');
            }
            
            $result = $this->db->insert($this->tableName, [
                'login' => $login,
                'email' => $email,
                'password' => $encoded,
                'reg_date' => date('Y-m-d H:i:s')
            ]);

            return $result;
        } catch (\Exception $e) {
            MyLogger::lg('An error occurred while creating a new user: ' . $e->getMessage(), 'Database error');
            return false;
        }
    }

    /**
     * Проверяет, зарегистрирован ли уже пользователь с логином $login
     * 
     * @param $login
     * @return bool
     */
    public function checkLogin($login)
    {
        return $this->db->isExists($this->tableName, 'login', $login);
    }

    /**
     * @param $login
     * @param $password
     * @return bool|array
     */
    public function getUser($login, $password)
    {
        $encoded = md5($password);
        
        $condition = sprintf(
            "`login` = '%s' AND `password` = '%s'",
            addslashes($login),
            addslashes($encoded)
        );
        
        $result = $this->db->getAllOnConditions($this->tableName, $condition, '', true, 1);
        
        if (is_array($result)) {
            return array_shift($result);
        }
        
        return false;
    }
}