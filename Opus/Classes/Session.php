<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 16.03.19
 * Time: 20:32
 */

namespace Opus;


class Session
{
    public function get($name, $defaultValue = null)
    {
        $result = $defaultValue;
        if (isset($_SESSION[$name])) {
            $result = unserialize($_SESSION[$name]);
        }
        return $result;
    }

    public function set($name, $value)
    {
        $_SESSION[$name] = serialize($value);
    }

    public function __get($name)
    {
        return $this->get($name);
    }

    public function __set($name, $value)
    {
        $this->set($name, $value);
    }
}