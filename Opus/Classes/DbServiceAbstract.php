<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 09.03.19
 * Time: 0:10
 */

namespace Opus;


abstract class DbServiceAbstract extends ServiceAbstract
{
    /**
     *  Возвращает PDO
     */
    public function getPdo()
    {
        return $this->getApp()->getPdo();
    }

    /**
     *  Возвращает ID последней добавленной в БД записи
     */
    public function getId()
    {
        try {
            return $this->getPdo()->lastInsertId();
        } catch (\Exception $e) {
            return null;
        }
    }

    protected function prepareStmt($sql, &$parameters)
    {
        $stmt = $this->getPdo()->prepare($sql);
        foreach ($parameters as $key => &$value) {
            if (is_array($value) && count($value) == 2) {
                $stmt->bindParam($key, $value[0], $value[1]);
            } else {
                $stmt->bindParam($key, $value);
            }
        }
        return $stmt;
    }

    /**
     *  Добавляет запись в таблицу
     */
    public function insert($tableName, array $data)
    {
        $fields = [];
        $holders = [];
        $parameters = [];

        $i = 1;
        foreach ($data as $field => $value) {
            $fields[] = $field;
            $holders[] = '?';
            $parameters[$i++] = $value;
        }

        $sql = "INSERT INTO {$tableName} (" . implode(',', $fields) . ") VALUES (" . implode(',', $holders) . ")";

        $stmt = $this->prepareStmt($sql, $parameters);
        $stmt->execute();

        return $this->getId();
    }

    /**
     *  Обновляет запись в таблице
     */
    public function update($tableName, array $data, array $conditions)
    {
        $fields = [];
        $parameters = [];

        $i = 1;
        foreach ($data as $field => $value) {
            $fields[] = $field . " = ?";
            $parameters[$i++] = $value;
        }

        $where = [];
        foreach ($conditions as $condition => $value) {
            if (strpos($condition, "?") === false) {$condition = $condition . " = ?";}
            $where[] = "(" . $condition . ")";
            $parameters[$i++] = $value;
        }

        $sql = "UPDATE {$tableName} SET " . implode(',', $fields) . " WHERE " . implode(' AND ', $where);

        $stmt = $this->prepareStmt($sql, $parameters);
        $stmt->execute();

    }

    /**
     *  Удаляет запись в таблице
     */
    public function delete($tableName, array $conditions)
    {
        $parameters = [];

        $i = 1;
        $where = [];
        foreach ($conditions as $condition => $value) {
            if (strpos($condition, "?") === false) {$condition = $condition . " = ?";}
            $where[] = "(" . $condition . ")";
            $parameters[$i++] = $value;
        }

        $sql = "DELETE FROM {$tableName} WHERE " . implode(' AND ', $where);

        $stmt = $this->prepareStmt($sql, $parameters);
        $stmt->execute();

    }
}