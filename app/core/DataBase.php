<?php

namespace App\Core;

/**
 * Class DataBase
 * @package App\Core
 */
class DataBase
{
    private $config;
    private $mysqli;
    private $validator;

    /**
     * DataBase constructor.
     */
    public function __construct()
    {
        $this->config = new Config();
        $this->validator = new Validator();
        $this->mysqli = new \mysqli(
            $this->config->dbHost,
            $this->config->dbUser,
            $this->config->dbPassword,
            $this->config->dbName
        );
        $this->mysqli->query("SET NAMES utf8");
    }

    /**
     * @param $query
     * @return bool|\mysqli_result
     */
    private function query($query)
    {
        return $this->mysqli->query($query);
    }

    /**
     * @param $table_name
     * @param $fields
     * @param string $where
     * @param string $order
     * @param bool $up
     * @param string $limit
     * @return array|bool
     */
    private function select($table_name, $fields, $where = "", $order = "", $up = true, $limit = "")
    {
        for ($i = 0; $i < count($fields); $i++) {
            if ((strpos($fields[$i], "(") === false) && ($fields[$i] != "*")) {
                $fields[$i] = "`" . $fields[$i] . "`";
            }
        }

        $fields = implode(",", $fields);
        $table_name = $this->config->dbPrefix . $table_name;

        if (!$order) {
            $order = "ORDER BY `id`";
        } else {
            if ($order !== "RAND()") {
                $order = "ORDER BY `$order`";
                if (!$up) $order .= " DESC";
            } else {
                $order = "ORDER BY $order";
            }
        }

        if ($limit) {
            $limit = "LIMIT $limit";
        }

        if ($where) {
            $query = "SELECT $fields FROM `$table_name` WHERE $where $order $limit";
        } else {
            $query = "SELECT $fields FROM `$table_name` $order $limit";
        }
        
        $result_set = $this->query($query);

        if (!$result_set) {
            return false;
        }

        $i = 0;
        $data = [];

        while ($row = $result_set->fetch_assoc()) {
            $data[$i] = $row;
            $i++;
        }

        $result_set->close();

        return $data;
    }

    /**
     * @param $table_name
     * @param $new_values
     * @return bool|\mysqli_result
     */
    public function insert($table_name, $new_values)
    {
        $table_name = $this->config->dbPrefix . $table_name;
        $query = "INSERT INTO `$table_name` (";

        foreach ($new_values as $field => $value) {
            $query .= "`" . $field . "`,";
        }

        $query = substr($query, 0, -1);
        $query .= ") VALUES (";

        foreach ($new_values as $value) {
            $query .= "'" . addslashes($value) . "',";
        }

        $query = substr($query, 0, -1);
        $query .= ")";

        MyLogger::lg($query);

        return $this->query($query);
    }

    /**
     * @param $table_name
     * @param $upd_fields
     * @param $where
     * @return bool|\mysqli_result
     */
    private function update($table_name, $upd_fields, $where)
    {
        $table_name = $this->config->dbPrefix . $table_name;
        $query = "UPDATE `$table_name` SET ";

        foreach ($upd_fields as $field => $value) {
            $query .= "`$field` = '" . addslashes($value) . "',";
        }

        $query = substr($query, 0, -1);

        if ($where) {
            $query .= " WHERE $where";

            return $this->query($query);
        }

        else return false;
    }

    /**
     * @param $table_name
     * @param string $where
     * @return bool|\mysqli_result
     */
    public function delete($table_name, $where = "")
    {
        $table_name = $this->config->dbPrefix . $table_name;

        if ($where) {
            $query = "DELETE FROM `$table_name` WHERE $where";

            return $this->query($query);
        } else {
            return false;
        }
    }

    /**
     * @param $table_name
     * @return bool|\mysqli_result
     */
    public function deleteAll($table_name)
    {
        $table_name = $this->config->dbPrefix . $table_name;
        $query = "TRUNCATE TABLE `$table_name`";

        return $this->query($query);
    }

    /**
     * @param $table_name
     * @param $field_out
     * @param $field_in
     * @param $value_in
     * @return bool
     */
    public function getField($table_name, $field_out, $field_in, $value_in)
    {
        $data = $this->select($table_name, array($field_out), "`$field_in` = '" . addslashes($value_in) . "'");

        if (count($data) != 1) {
            return false;
        }

        return $data[0][$field_out];
    }

    /**
     * @param $table_name
     * @param $id
     * @param $field_out
     * @return bool
     */
    public function getFieldOnID($table_name, $id, $field_out)
    {
        if (!$this->existsID($table_name, $id)) {
            return false;
        }

        return $this->getField($table_name, $field_out, "id", $id);
    }

    /**
     * @param $table_name
     * @param $order
     * @param $up
     * @return array|bool
     */
    public function getAll($table_name, $order, $up)
    {
        return $this->select($table_name, array("*"), "", $order, $up);
    }

    /**
     * @param $table_name
     * @param $field
     * @param $value
     * @param $order
     * @param $up
     * @return array|bool
     */
    public function getAllOnField($table_name, $field, $value, $order, $up)
    {
        return $this->select($table_name, array("*"), "`$field` = '" . addslashes($value) . "'", $order, $up);
    }

    /**
     * @param $table_name
     * @param $conditions
     * @param $order
     * @param $up
     * @param $limit
     * @return array|bool
     */
    public function getAllOnConditions($table_name, $conditions, $order, $up, $limit)
    {
        return $this->select($table_name, array('*'), $conditions, $order, $up, $limit);
    }

    /**
     * @param $table_name
     * @return mixed
     */
    public function getLastId($table_name)
    {
        $data = $this->select($table_name, array("MAX(`id`)"));

        return $data[0]["MAX(`id`)"];
    }

    /**
     * @param $table_name
     * @param $id
     * @return bool|\mysqli_result
     */
    public function deleteOnID($table_name, $id)
    {
        if (!$this->existsID($table_name, $id)) {
            return false;
        }

        return $this->delete($table_name, "`id` = '$id'");
    }

    /**
     * @param $table_name
     * @param $upd_fields
     * @param $id
     * @return bool|\mysqli_result
     */
    public function updateOnId($table_name, $upd_fields, $id)
    {
        if (!$this->existsID($table_name, $id)) {
            return false;
        }

        return $this->update($table_name, $upd_fields, "`id` = '$id'");
    }

    /**
     * @param $table_name
     * @param $field
     * @param $value
     * @param $field_in
     * @param $value_in
     * @return bool|\mysqli_result
     */
    public function setField($table_name, $field, $value, $field_in, $value_in)
    {
        return $this->update($table_name, array($field => $value), "`$field_in` = '" . addslashes($value_in) . "'");
    }

    /**
     * @param $table_name
     * @param $id
     * @param $field
     * @param $value
     * @return bool|\mysqli_result
     */
    public function setFieldOnID($table_name, $id, $field, $value)
    {
        if (!$this->existsID($table_name, $id)) {
            return false;
        }

        return $this->setField($table_name, $field, $value, "id", $id);
    }

    /**
     * @param $table_name
     * @param $id
     * @return bool|mixed
     */
    public function getElementOnID($table_name, $id)
    {
        if (!$this->existsID($table_name, $id)) {
            return false;
        }

        $arr = $this->select($table_name, array("*"), "`id` = '$id'");

        return $arr[0];
    }

    /**
     * @param $table_name
     * @param $count
     * @return array|bool
     */
    public function getRandomElements($table_name, $count)
    {
        return $this->select($table_name, array("*"), "", "RAND()", $count);
    }

    /**
     * @param $table_name
     * @return mixed
     */
    public function getCount($table_name)
    {
        $data = $this->select($table_name, array("COUNT(`id`)"));

        return $data[0]["COUNT(`id`)"];
    }

    /**
     * @param $table_name
     * @param $field
     * @param $value
     * @return bool
     */
    public function isExists($table_name, $field, $value)
    {
        $data = $this->select($table_name, array("id"), "`$field` = '" . addslashes($value) . "'");

        if (count($data) === 0) {
            return false;
        }

        return true;
    }

    /**
     * @param $table_name
     * @param $id
     * @return bool
     */
    private function existsID($table_name, $id)
    {
        if (!$this->validator->validID($id)) {
            return false;
        }

        $data = $this->select($table_name, array("id"), "`id` = '" . addslashes($id) . "'");

        if (count($data) === 0) {
            return false;
        }

        return true;
    }

    /**
     * @param $query
     * @return array|bool
     */
    public function customQuery($query)
    {
        $result_set = $this->query($query);

        if (!$result_set) {
            return false;
        }

        $i = 0;
        $data = [];

        while ($row = $result_set->fetch_assoc()) {
            $data[$i] = $row;
            $i++;
        }

        $result_set->close();

        return $data;
    }

    /**
     * DataBase destructor.
     */
    public function __destruct()
    {
        if ($this->mysqli) $this->mysqli->close();
    }
}