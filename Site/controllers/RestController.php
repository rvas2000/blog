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
            return ['result' => 1, 'data' => array_map(function ($v) {$v['name'] = htmlspecialchars($v['name']); return $v;}, $rows)];
        } catch (Exception $e) {
            // return $e->getMessage();
            return ['result' => 0, 'error' => $e->getMessage()];
        }

    }


    public function actionSaveTag()
    {
        try {
            $id = $this->getRequest()->getParameter('id');
            $name = $this->getRequest()->getParameter('name');
            $data = ['name' => $name];
            if (! empty($id)) {$data['id'] = $id;}
            $id = $this->getService('db')->saveTag($data);
            return ['result' => 1, 'data' => $id];
        } catch (Exception $e) {
            return ['result' => 0, 'error' => $e->getMessage()];
        }
    }


    public function actionDeleteTag()
    {
        try {
            $id = $this->getRequest()->getParameter('id');
            if ( ! empty($id)) {
                $this->getService('db')->deleteTag($id);
            }
            return ['result' => 1, 'data' => $id];
        } catch (Exception $e) {
            return ['result' => 0, 'error' => $e->getMessage()];
        }

    }


    public function actionDeleteGalleryTags()
    {
        try {
            $tagsId = $this->getRequest()->getParameter('tags_id');
            $galleryId = $this->getRequest()->getParameter('gallery_id');
            if ( ! (empty($tagsId) || empty($galleryId) )) {
                $this->getService('db')->deleteGalleryTags($galleryId, $tagsId);
            }
            return ['result' => 1];
        } catch (Exception $e) {
            return ['result' => 0, 'error' => $e->getMessage()];
        }

    }



    public function actionAddGalleryTags()
    {
        try {
            $tagsId = $this->getRequest()->getParameter('tags_id');
            $galleryId = $this->getRequest()->getParameter('gallery_id');
            if ( ! (empty($tagsId) || empty($galleryId) )) {
                $this->getService('db')->addGalleryTags($galleryId, $tagsId);
            }
            return ['result' => 1];
        } catch (Exception $e) {
            return ['result' => 0, 'error' => $e->getMessage()];
        }

    }

    public function actionSaveGallery()
    {
        try {
            $id = $this->getRequest()->getParameter('id');
            $description = $this->getRequest()->getParameter('description');
            $img = $this->getRequest()->getParameter('img');

            $data = [];
            if ($id !== null) $data['id'] = $id;
            if ($description !== null) $data['description'] = $description;
            if ($img !== null) $data['img'] = $img;

            if (count($data)) {
                $id = $this->getService('db')->saveGallery($data);
            }
            return ['result' => 1, 'data' => $id];
        } catch (Exception $e) {
            return ['result' => 0, 'error' => $e->getMessage()];
        }
    }


    public function actionDeleteGallery()
    {
        try {
            $id = $this->getRequest()->getParameter('id');
            if ( ! empty($id)) {
                $this->getService('db')->deleteGallery($id);
            }
            return ['result' => 1, 'data' => $id];
        } catch (Exception $e) {
            return ['result' => 0, 'error' => $e->getMessage()];
        }

    }


    public function actionUpload()
    {
        try {
            $fileName = $this->getApp()->getUploader()->upload('fff', '/images/gallery');
            return ['result' => 1, 'data' => $fileName];
        } catch (Exception $e) {

            return ['result' => 0, 'error' => $e->getMessage()];
        }
    }

    public function actionTest()
    {
        $this->getApp()->getResponse()->setType('html');
        $this->getService('db')->update('tags', ['name' => 'Киви'], ['id' => 3]);
        return 1;
    }
}