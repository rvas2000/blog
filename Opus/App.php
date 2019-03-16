<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 06.03.19
 * Time: 21:57
 */
namespace Opus;

class App
{
    private static $app = null;

    private $request = null;

    private $controller = null;

    private $view = null;

    private $services = [];

    private $response = null;

    private $config = null;

    private $pdo = null;

    private $log = null;

    private $auth = null;

    private $session = null;

    /**
     *  Возвращает PDO 
     */
    public function getPdo()
    {
        if ($this->pdo === null) {
            $settings = $this->getConfig()['db'];
            $dsn = $settings['prefix'] . ':';

            $user = null;
            $password = null;
            foreach ($settings as $key => $value) {
                if (! in_array($key, ['prefix', 'user', 'password'])) {
                    $dsn .= ';' . $key . '=' . $value; 
                } else {
                    if ($key == 'user') $user = $value;
                    if ($key == 'password') $password = $value;
                }
            }
            $options = [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            ];

            $this->pdo = new \PDO($dsn, $user, $password, $options);
        }
        return $this->pdo;
    }


    /**
     *  Возвращает объект для рабооты с логом приложения
     */
    public function getLog()
    {
        if ($this->log === null) {
            $this->log = new Log();
        }
        return $this->log;
    }

    /**
     *  Возвращает объект для работы с HTTP-запросом
     */
    public function getRequest()
    {
        if ($this->request === null) {
            $this->request = new Request();
        }

        return $this->request;
    }

    /**
     *  Возвращает массив настроек приложения
     */
    public function getConfig()
    {
        if ($this->config === null) {
            $path = __DIR__ . '/../Site/config.conf';
            $this->config = parse_ini_file($path, true);
        }
        return $this->config;
    }

    /**
     *  Возвращает объект HTTP-ответа
     */
    public function getResponse()
    {
        if ($this->response === null) {
            $this->response = new Response();
        }
        return $this->response;
    }

    /**
     *  Преобразует имя в camelCase
     */
    public function getCanonicalName($name)
    {
        $nameParts = explode('-', $name);
        return implode('', array_map(function ($v) {return ucfirst(strtolower($v));}, $nameParts));
    }


    /**
     *  Возвращает объект сервиса по его имени
     */
    public function getService($name)
    {
        if (! isset($this->services[$name])) {
            $className = '\\' . $this->getCanonicalName($name) . 'Service';
            $this->services[$name] = new $className();
        }
        return $this->services[$name];
    }

    /**
     *  Возвращает единственный экземпляр приложения
     */
    public static function getInstance()
    {
        if (self::$app === null) {
            self::$app = new self;
        }
        return self::$app;
    }

    /**
     *  Возвращает объект представления
     */
    public function getView()
    {
        if ($this->view === null) {
            $this->view = new View();
        }
        return $this->view;
    }

    public function getAuth()
    {
        if ($this->auth === null) {
            $this->auth = new Auth();
        }
        return $this->auth;
    }


    public function getSession()
    {
        if ($this->session === null) {
            $this->session = new Session();
        }
        return $this->session;
    }

    /**
     *  Главная процедура
     */
    public function run()
    {
        session_start();
        ob_start();
        $controller = $this->getRequest()->getController();
        $action = $this->getRequest()->getAction();

        $controlerClass = $this->getCanonicalName($controller) . 'Controller';
        $actionName = 'action' . $this->getCanonicalName($action);

        $this->controller = new $controlerClass();
        $this->controller->init();
        $content = $this->controller->{$actionName}();

        $this->getResponse()->setContent($content);
        $this->getResponse()->flush();
        ob_end_flush();
    }

}