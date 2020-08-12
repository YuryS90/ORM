<?php

namespace W1019;

use mysqli;

class DbTable implements CRUDInterface
{
    private $mysqli;
    private $tableName;

    public function __construct(mysqli $mysqli, $tableName)
    {
        $this->mysqli = $mysqli;
        $this->tableName = $tableName;
    }

    /**
     * READ
     */
    public function get(): array
    {
        $result = $this->mysqli->query("SELECT * FROM $this->tableName;");

        $array = [];
        while ($row = $result->fetch_assoc()) {
            $array[] = $row;
        }
        return $array;
    }

    /**
     * create
     */
    public function add(array $data): int
    {
        /**
         * Изначально запрос выглядет так:
         * INSERT INTO `$this->tableName` (`Text`, `Name`) VALUES ('helllo', 'hh') "
         */

        // делаем по-правильному первый список - это (`Text`, `Name`)
        $fildNames = [];
        foreach (array_keys($data) as $value) {
            $fildNames[] = $value;
        }

        //генерация запроса
        $sql =
            "INSERT INTO `$this->tableName`" .
            "(`" . implode("`, `", $fildNames) . "`) " .
            "VALUES ('" . implode("', '", $data) . "');";

        // выполенение запроса
        $this->mysqli->query($sql);

        return $this->mysqli->insert_id;
    }

    /**
     * update
     */
    public function edit(int $id, array $data)
    {
        /**
         * Изначально запрос выглядет так:
         * UPDATE `table124` SET `Name` = 'Jeckkkkk', `Text` = 'wow' WHERE `id` = '4';
         */
        $editData = [];
        foreach ($data as $key => $value) {
            $editData[] = "`$key` = '$value'";
        }

        //генерация запроса
        $sql =
            "UPDATE `$this->tableName` 
            SET " . implode(", ", $editData) . "
            WHERE `id` = '$id';";

        // выполенение запроса
        $this->mysqli->query($sql);
        return $this;
    }

    /**
     * delete
     */
    public function del(int $id)
    {
        //генерация запроса
        $sql = "DELETE FROM `$this->tableName` WHERE `id` = $id;";

        // выполенение запроса
        $this->mysqli->query($sql);
        return $this;
    }
}
