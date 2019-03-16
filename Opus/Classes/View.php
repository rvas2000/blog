<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 07.03.19
 * Time: 0:01
 */

namespace Opus;


class View
{
    protected $template = null;

    protected $js = [];

    protected $css = [];

    /**
     *  Регитрирует css-файл на странице
     */
    public function registerCss($css)
    {
        $this->css[$css] = $css;
    }

    /**
     *  Регистрирует js-файл на странице
     */
    public function registerJs($js)
    {
        $this->js[$js] = $js;
    }

    /**
     *  Возвращает экземпляр приложения
     */
    public function getApp()
    {
        return App::getInstance();
    }

    /**
     *  Возвращает путь к папке с шаблоном
     */
    public function getTemplatePath()
    {
        return realpath(__DIR__ . '/../../Site/views/' . $this->getApp()->getRequest()->getController());
    }

    /**
     *  Возвращает путь к папке с макетом
     */
    public function getLayoutPath()
    {
        return realpath(__DIR__ . '/../../Site/views/layout.php');
    }

    /**
     *  Возвращает полное имя файла шаблона 
     */
    public function getTemplateName()
    {
        if ($this->template === null) {
            $this->template = $this->getApp()->getRequest()->getAction();
        }
        return $this->getTemplatePath() . '/' . $this->template . '.php';

    }

    /**
     *  Выводит ссылки на js-файлы на страницу 
     */
    public function renderJs()
    {
        return implode(PHP_EOL, array_map(function ($v) {return '<script type="text/javascript" src="' . $v . '"></script>';}, $this->js));
    }

    /**
     *  Выводит сслыки на css-файлы на страницу
     */
    public function renderCss()
    {
        return implode(PHP_EOL, array_map(function ($v) {return '<link rel="stylesheet" href="' . $v . '"/>';}, $this->css));
    }

    /**
     *  Рендерит данные по шаблону   
     */
    public function render($values = [], $template = null)
    {
        ob_start();
        $this->template = $template;
        $layoutPath = $this->getLayoutPath();
        extract($values);
        if ($layoutPath !== false) { include $layoutPath;}
        $this->template = null;
        return ob_get_clean();
    }
}