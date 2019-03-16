<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 07.03.19
 * Time: 21:33
 */

namespace Opus;


abstract class ServiceAbstract
{
    /**
     *  Возвращает экземпляр приложения
     */
    public function getApp()
    {
        return App::getInstance();
    }

    /**
     *  Возвращает объект сервиса по его имени
     */
    public function getService($name)
    {
    	return $this->getApp()->getService($name);
    }

}