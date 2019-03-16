<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 16.03.19
 * Time: 20:01
 */

namespace Opus;


class Auth
{

    public function getApp()
    {
        return App::getInstance();
    }

    public function login($password)
    {
        $this->logout();
        if (strtoupper(md5($password)) === $this->getApp()->getConfig()['auth']['password_md5']) {
            $this->getApp()->getSession()->set('86e9c27b5e12a27432574e00d2bb342f', true);
        }

    }

    public function logout()
    {
        $this->getApp()->getSession()->set('86e9c27b5e12a27432574e00d2bb342f', false);
    }

    public function isAuthorized()
    {
        return $this->getApp()->getSession()->get('86e9c27b5e12a27432574e00d2bb342f', false);
    }
}