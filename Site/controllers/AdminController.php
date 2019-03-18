<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 16.03.19
 * Time: 22:58
 */

use Opus\Controller;

class AdminController extends Controller
{

    public function actionIndex()
    {
        if (! $this->getApp()->getAuth()->isAuthorized()) {
            $this->getApp()->getResponse()->redirect('/');
            return;
        }
        $this->getView()->registerCss('css/admin/index.css');
        $this->getView()->registerJs('js/admin/index.js');
        return $this->render();
    }

    public function actionGetTagsAjax()
    {
        $tag = $this->getRequest()->getParameter('tag');

        $items = $this->getService('db')->getTags($tag);
        return $this->renderPartial('_all-tags', ['items' => $items]);

    }

    public function actionGetEmptyTagAjax()
    {
        return $this->renderPartial('_tag', ['item' => ['id' => '', 'name' => '']]);
    }

    public function actionGetGalleryAjax()
    {
        $tag = $this->getRequest()->getParameter('tag');

        $items = $this->getService('db')->getGallery($tag);
        return $this->renderPartial('_all-gallery', ['items' => $items]);

    }


    public function actionGetEmptyGalleryAjax()
    {
        return $this->renderPartial('_gallery', ['item' => ['guid' => '', 'img' => 'noimage.png', 'description' => '', 'tags' => []]]);
    }

}