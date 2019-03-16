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


    /**
     * Получение списка новостей
     * @return array
     */
    public function actionIndex()
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


    /**
     * Получение списка картинок с тегами
     * @return array
     */
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
     * Получение списка тегов
     * @return array
     */
    public function actionGetTags()
    {
        try {
            $tag = $this->getRequest()->getParameter('tag');

            $rows = $this->getService('db')->getTags($tag);
            return ['result' => 1, 'data' => $rows];
        } catch (Exception $e) {
            // return $e->getMessage();
            return ['result' => 0, 'error' => $e->getMessage()];
        }

    }
}