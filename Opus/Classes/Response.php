<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 07.03.19
 * Time: 21:42
 */

namespace Opus;


class Response
{
    const CONTENT_TYPE_HTML = 'text/html; charset=UTF-8';
    const CONTENT_TYPE_JSON = 'application/json; charset=UTF-8';
    const CONTENT_TYPE_TEXT = 'text/plain; charset=UTF-8';


    protected $type = 'html';

    protected $content = '';

    protected $headers = ['Content-Type' => self::CONTENT_TYPE_HTML];

    /**
     *  Устанавливает содержимое HTTP-ответа
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     *  Устанавливает тип HTTP-ответа
     */
    public function setType($type)
    {
        $this->type = $type;
        if ($type == 'json') {
            $this->setHeader('Content-Type', self::CONTENT_TYPE_JSON);
        } elseif ($type == 'text') {
            $this->setHeader('Content-Type', self::CONTENT_TYPE_TEXT);
        } else {
            $this->setHeader('Content-Type', self::CONTENT_TYPE_TEXT);
        }
    }

    /**
     *  Устанавливает заголовок HTTP-ответа
     */
    public function setHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    /**
     *  Выдает HTTP-ответ клиенту
     */
    public function flush()
    {
        foreach ($this->headers as $key => $value) {
            $header = sprintf("%s: %s", $key, $value);
            header($header, true);
        }

        if ($this->type === 'json') {
            echo json_encode($this->content);
        } else {
            echo $this->content;
        }
    }
}