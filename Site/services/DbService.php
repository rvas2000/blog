<?php

use Opus\DbServiceAbstract;

class DbService extends DbServiceAbstract
{
    /**
     * Получение списка новостей
     * @param null $dateFrom - дата с
     * @param null $dateTo - дата по
     * @param null $header - фрагмент заголовка
     * @param null $fromId - Начиная с какого ID выбирать записи
     * @return array
     */
    public function getNews($dateFrom = null, $dateTo = null, $header = null, $fromId = null)
    {
        $conditions = [];
        $parameters = [];
        
        $i = 1;
        if (! empty($dateFrom)) {
            if ( ! empty($dateTo) ) {
                $conditions[] = "created_at BETWEEN ?::timestamp AND ?::timestamp";
                $parameters[$i++] = [$dateFrom, \PDO::PARAM_STR];
                $parameters[$i++] = [$dateTo, \PDO::PARAM_STR];
            } else {
                $conditions[] = "created_at >= ?::timestamp";
                $parameters[$i++] = [$dateFrom, \PDO::PARAM_STR];
            };
        }

        if ( ! empty($header) ) {
            $conditions[] = "header LIKE CONCAT('%', ?::varchar(255), '%')";
            $parameters[$i++] = [$header, \PDO::PARAM_STR];
        }

        if ($fromId !== null && is_numeric($fromId)) {
            $conditions[] = "id > ?";
            $parameters[$i++] = [(int) $fromId, \PDO::PARAM_INT];
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


    /**
     * Получение списка картинок
     * @param $tag - фрагмент тега
     * @return array
     */
    public function getGallery($tag = null)
    {
        $conditions = [];
        $parameters = [];
        
        $i = 1;
        if (! empty($tag) ) {
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


    /**
     * Получение списка тегов
     * @param $tag - фрагмент тега для поиска
     * @return array
     */
    public function getTags($tag)
    {
        $conditions = [];
        $parameters = [];

        $i = 1;
        if ( ! empty($tag) ) {
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

    public function saveTag($data)
    {
        $id = null;
        if (isset($data['id'])) {
            $id = $data['id'];
            unset($data['id']);
        }

        if (empty($id)) {
            $id = $this->insert('tags', $data);
        } else {
            $this->update('tags', $data, ['id' => $id]);
        }
        return $id;
    }

    public function deleteTag($id)
    {
        $this->delete('tags', ['id' => $id]);
    }
}