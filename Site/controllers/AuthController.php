<?php

use Opus\Controller;

class AuthController extends Controller
{
    public function actionLogin()
    {
        $password = $this->getRequest()->getParameter('password');
        if ( ! empty($password)) {
            $this->getApp()->getAuth()->login($password);
        }
        $this->getApp()->getResponse()->redirect('/');
    }

    public function actionLogout()
    {
        $this->getApp()->getAuth()->logout();
        $this->getApp()->getResponse()->redirect('/');
    }

}