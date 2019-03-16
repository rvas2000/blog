<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 06.03.19
 * Time: 23:55
 */

use Opus\Controller;

class DefaultController extends Controller
{
    /**
     *
     */
    public function actionIndex()
    {
        $this->getView()->registerCss('/css/default/index.css');
        $this->getView()->registerJs('/js/default/index.js');
        return $this->render();
    }


    public function actionGetNewsAjax()
    {
        $dateFrom = $this->getRequest()->getParameter('date_from');
        $dateTo = $this->getRequest()->getParameter('date_to');
        $header = (string) $this->getRequest()->getParameter('header');
        $fromId = (string) $this->getRequest()->getParameter('from_id');

        $news = $this->getService('db')->getNews($dateFrom, $dateTo, $header, $fromId);
        return $this->renderPartial('_all-news', ['news' => $news]);
    }

}