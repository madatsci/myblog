<?php

namespace App\Core;

/**
 * Class Validator
 * @package App\Core
 */
class Validator
{
    private $config;
    
    const MD5_HASH_LENGTH = 32;

    /**
     * Validator constructor.
     */
    public function __construct()
    {
        $this->config = new Config();
    }

    /**
     * @param $id
     * @return bool
     */
    public function validID($id)
    {
        if (!$this->isIntNumber($id)) {
            return false;
        }

        if ($id <= 0) {
            return false;
        }

        return true;
    }

    /**
     * @param $login
     * @return bool
     */
    public function validLogin($login)
    {
        if ($this->isContainQuotes($login)) {
            return false;
        }

        if (preg_match("/^\\d*$/", $login)) {
            return false;
        }

        return $this->validString($login, $this->config->minLoginLength, $this->config->maxLoginLength);
    }

    /**
     * @param $hash
     * @return bool
     */
    public function validHash($hash)
    {
        if (!$this->validString($hash, self::MD5_HASH_LENGTH, self::MD5_HASH_LENGTH)) {
            return false;
        }

        if (!$this->isOnlyLettersAndDigits($hash)) {
            return false;
        }

        return true;
    }

    /**
     * @param $time
     * @return bool
     */
    public function validTimeStamp($time)
    {
        return $this->isNoNegativeInteger($time);
    }

    /**
     * @param $number
     * @return bool
     */
    private function isIntNumber($number)
    {
        if (!is_int($number) && !is_string($number)) {
            return false;
        }

        if (!preg_match("/^-?([1-9][0-9]*|0)$/", $number)) {
            return false;
        }

        return true;
    }

    /**
     * @param $number
     * @return bool
     */
    public function isNoNegativeInteger($number)
    {
        if (!$this->isIntNumber($number)) {
            return false;
        }

        if ($number < 0) {
            return false;
        }

        return true;
    }

    /**
     * @param $string
     * @return bool
     */
    private function isOnlyLettersAndDigits($string)
    {
        if (!is_int($string) && (!is_string($string))) {
            return false;
        }

        if (!preg_match("/[a-zа-я0-9]*/i", $string)) {
            return false;
        }

        return true;
    }

    /**
     * @param $string
     * @param $min_length
     * @param $max_length
     * @return bool
     */
    private function validString($string, $min_length, $max_length)
    {
        if (!is_string($string)) {
            return false;
        }

        if (strlen($string) < $min_length) {
            return false;
        }

        if (strlen($string) > $max_length) {
            return false;
        }

        return true;
    }

    /**
     * @param $string
     * @return bool
     */
    private function isContainQuotes($string)
    {
        $array = array("\"", "'", "`", "&quot;", "&apos;");

        foreach ($array as $key => $value) {
            if (strpos($string, $value) !== false) {
                return true;
            }
        }

        return false;
    }
}