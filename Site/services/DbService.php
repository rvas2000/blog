<?php

use Opus\DbServiceAbstract;

class DbService extends DbServiceAbstract
{
    public function getNews($dateFrom = null, $dateTo = null, $header = null)
    {
        $conditions = [];
        $parameters = [];
        
        $i = 1;
        if ($dateFrom !== null) {
            if ($dateTo !== null) {
                $conditions[] = "created_at BETWEEN ?::timestamp AND ?::timestamp";
                $parameters[$i++] = [$dateFrom, \PDO::PARAM_STR];
                $parameters[$i++] = [$dateTo, \PDO::PARAM_STR];
            } else {
                $conditions[] = "created_at >= ?::timestamp";
                $parameters[$i++] = [$dateFrom, \PDO::PARAM_STR];
            };
        }

        if ($header !== null) {
            $conditions[] = "header LIKE CONCAT('%', ?::varchar(255), '%')";
            $parameters[$i++] = [$header, \PDO::PARAM_STR];
        }

        $where = '';
        if (count($conditions)) {
            $where = "WHERE " . implode(' AND ', $conditions);
        }

        $sql = "SELECT * FROM news " . $where . " ORDER BY id DESC";

        $stmt = $this->prepareStmt($sql, $parameters);
        $stmt->execute();
        $rs = $stmt->fetchAll();

        return $rs;
    }


    public function getGallery($tag)
    {
        $conditions = [];
        $parameters = [];
        
        $i = 1;
        if ($tag !== null) {
            $conditions[] = "c.name LIKE CONCAT('%', ?::varchar(255), '%')";
            $parameters[$i++] = [$tag, \PDO::PARAM_STR];
        }

        $where = '';
        if (count($conditions)) {
            $where = "WHERE " . implode(' AND ', $conditions);
        }

        $sql = "SELECT a.id AS guid, a.img, a.description, c.id AS tag_id, c.name AS tag_name " .
        "FROM gallery a " .
        "LEFT JOIN gallery_tags b ON a.id = b.gallery_id " .
        "LEFT JOIN tags c ON b.tags_id = c.id " . $where . " ORDER BY a.id, c.id";

        $stmt = $this->prepareStmt($sql, $parameters);
        $stmt->execute();
        $rs = $stmt->fetchAll();

        $result = [];
        foreach ($rs as $item) {
            if (! isset($result[$item['guid']])) {
                $result[$item['guid']] = [
                    'guid' => $item['guid'],
                    'img' => $item['img'],
                    'description' => $item['description'],
                    'tags' => []
                ];
            }

            if (! empty($item['tag_id']) ) {
                $result[$item['guid']]['tags'][] = ['id' => $item['tag_id'], 'name' => $item['tag_name']];
            }

        }

        return $result;
    }



    public function getTags($tag)
    {
        $conditions = [];
        $parameters = [];

        $i = 1;
        if ($tag !== null) {
            $conditions[] = "name LIKE CONCAT('%', ?::varchar(255), '%')";
            $parameters[$i++] = [$tag, \PDO::PARAM_STR];
        }

        $where = '';
        if (count($conditions)) {
            $where = "WHERE " . implode(' AND ', $conditions);
        }

        $sql = "SELECT * FROM tags ". $where;

        $stmt = $this->prepareStmt($sql, $parameters);
        $stmt->execute();
        $rs = $stmt->fetchAll();

        return $rs;
    }
}