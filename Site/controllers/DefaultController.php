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
        $items = $this->getService('db')->getTransport();
        return $this->render(['items' => $items]);
    }

    /**
     *
     */
    public function actionForm()
    {
        $this->getView()->registerCss('/css/default/form.css');
        $this->getView()->registerJs('/js/default/form.js');
        $names = $this->getService("generate-transport")->transport;
        $directions = $this->getService("generate-transport")->streets;
        return $this->render(['names' => $names, 'directions' => $directions]);
    }
}