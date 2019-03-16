<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 06.03.19
 * Time: 23:55
 */

namespace Opus;


class Controller
{
    public function init() {

    }

    /**
     *  Возвращает экземпляр приложения
     */
    public function getApp()
    {
        return App::getInstance();
    }

    /**
     *  Устанавливает тип ответа
     */
    public function setResponseType($type)
    {
        $this->getApp()->getResponse()->setType($type);
    }

    /**
     *  Возвращает экземпляр представления
     */
    public function getView()
    {
        return $this->getApp()->getView();
    }

    /**
     *  Возвращает экземпляр HTTP-запроса
     */
    public function getRequest()
    {
        return $this->getApp()->getRequest();
    }

    /**
     *  Возвращает объект сервиса по его имени
     */
    public function getService($name)
    {
        return $this->getApp()->getService($name);
    }

    /**
     *  Рендерит результат в соответствии с шаблоном
     */
    public function render($values = [], $templateName = null)
    {
        return $this->getApp()->getView()->render($values, $templateName);
    }


    /**
     *  Рендерит результат в соответствии с шаблоном без учета макета
     */
    public function renderPartial($templateName, $values = [])
    {
        return $this->getApp()->getView()->renderPartial($templateName, $values);
    }

}