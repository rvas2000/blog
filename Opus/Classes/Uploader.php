<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 17.03.19
 * Time: 23:49
 */

namespace Opus;


class Uploader
{

    public function upload($name, $uploadPath)
    {
        if (isset($_FILES[$name])) {
            $uploadPath = realpath(BASE_PATH . $uploadPath);
            if ($uploadPath === false) throw new \Exception('Указан неверный путь для загрузки файла');
            $file = $_FILES[$name];
            if ($file['error'] != 0) throw new \Exception('Ошибка загрузки файла');

            if (preg_match('/^(.+)(\\.[^\\.]+)$/', $file['name'], $m)) {
                $fileName = uniqid() . $m[2];
            } else {
                $fileName = uniqid();
            }
            $fullName = $uploadPath . '/' . $fileName;
            move_uploaded_file($file['tmp_name'], $fullName);
            return $fileName;
        } else {
            throw new \Exception('Файл не найден');
        }
    }
}