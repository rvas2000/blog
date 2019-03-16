<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 06.03.19
 * Time: 23:24
 */

namespace Opus;


class Request
{
    private $parameters = null;

    private $controller = 'default';
    private $action = 'index';

    /**
     * Загружает значения параметров из массивов _GET и __POST 
     */
    private function loadParameters()
    {
        if ($this->parameters === null) {
            $this->parameters = [];

            if (isset($_GET)) {
                foreach ($_GET as $key => $value) {
                    if ($key === 'controller') {
                        $this->controller = $value;
                    } elseif ($key === 'action') {
                        $this->action = $value;
                    } else {
                        $this->parameters[$key] = $value;
                    }
                }
            }

            if (isset($_POST)) {
                foreach ($_POST as $key => $value) {
                    $this->parameters[$key] = $value;
                }
            }
        }
    }

    /**
     *  Возвращает массив загруженных параметров
     */
    public function getParameters()
    {
        $this->loadParameters();
        return $this->parameters;
    }

    /**
     *  Возвращает название контроллера, как оно передано в запросе
     */
    public function getController()
    {
        $this->loadParameters();
        return $this->controller;
    }


    /**
     *  Возвращает название действия, как оно передано в запросе
     */
    public function getAction()
    {
        $this->loadParameters();
        return $this->action;
    }

    /**
     *  Возвращает значение параметра HTTP-запроса по его имени
     */
    public function getParameter($name, $defaultValue = null)
    {
        $result = $defaultValue;
        if (isset($this->getParameters()[$name])) {
            $result = $this->getParameters()[$name];
        }
        return $result;
     }
}