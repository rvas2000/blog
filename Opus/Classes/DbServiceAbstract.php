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
        return $this->getPdo()->lastInsertId();
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

        foreach ($data as $field => $value) {
            $fields[] = "`{$field}`";
            $holders[] = '?';
            $parameters[] = $value;
        }

        $sql = "INSERT INTO `{$tableName}` (" . implode(',', $fields) . ") VALUES (" . implode(',', $holders) . ")";
        $this->getApp()->getLog()->save([$sql, $parameters]);

        $stmt = $this->prepareStmt($sql, $parameters);
        $stmt->execute();

        return $this->getId();
    }

}