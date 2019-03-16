<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 07.03.19
 * Time: 22:12
 */

use Opus\Controller;

class RestController extends Controller
{
    /**
     *   Инициализация контроллера - устанавливаем формат вывода json
     */
    public function init()
    {
        parent::init();
        $this->setResponseType('json');
    }


    public function actionGetNews()
    {
        try {
            $dateFrom = $this->getRequest()->getParameter('date_from');
            $dateTo = $this->getRequest()->getParameter('date_to');
            $header = (string) $this->getRequest()->getParameter('header');

            $rows = $this->getService('db')->getNews($dateFrom, $dateTo, $header);   
            return ['result' => 1, 'data' => $rows];
        } catch (Exception $e) {
            // return $e->getMessage();
            return ['result' => 0, 'error' => $e->getMessage()];
        }

    }


    public function actionGetGallery()
    {
        try {
            $tag = $this->getRequest()->getParameter('tag');

            $rows = $this->getService('db')->getGallery($tag);   
            return ['result' => 1, 'data' => $rows];
        } catch (Exception $e) {
            // return $e->getMessage();
            return ['result' => 0, 'error' => $e->getMessage()];
        }

    }

    /**
     *   Получение списка записей из таблицы transport, начиная с id, большего from_id
     */
    public function actionIndex()
    {
        try {
            $fromId = $this->getRequest()->getParameter('from_id', 0);
            $rows = $this->getService('db')->getTransport($fromId);   
            return ['result' => 1, 'data' => ['rows' => $rows]];
        } catch (Exception $e) {
            return ['result' => 0, 'error' => $e->getMessage()];
        }
    }

    /**
     *   Добавление в таблицу transort случайной записи
     */
    public function actionGenerate()
    {
        try {
            // Удаляем автоматически добавленные записи старше 2 минут
            $this->getService('db')->deleteOldTransport(120);
            // Генерируем случайную запись и добавляем ее
            $data = $this->getService('generate-transport')->getRandomRecord();
            $id = $this->getService('db')->insertTransport($data);   
            return ['result' => 1, 'data' => ['id' => $id]];
        } catch (Exception $e) {
            return ['result' => 0, 'error' => $e->getMessage()];
        }

    }

    /**
     *   Обработка ручного добавления записи в таблицу transport
     */
    public function actionSave()
    {
        try {
            // Получаем данные из формы
            $data = $this->getRequest()->getParameter('transport');
            $data['handle'] = true; // принудительно задаем тип ввода ручной
            $id = $this->getService('db')->insertTransport($data); // добавляем запись
            return ['result' => 1, 'data' => ['id' => $id]];
        } catch (Exception $e) {
            return ['result' => 0, 'error' => $e->getMessage()];
        }
    }

}