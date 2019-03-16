<?php
/**
 * Created by PhpStorm.
 * User: basil
 * Date: 07.03.19
 * Time: 22:38
 */

use Opus\ServiceAbstract;

class GenerateTransportService extends ServiceAbstract
{
    public $streets = [
        'ул. Чехова',
        'ул. Пушкина',
        'ул. Герцена',
        'ул. Льва Толстого',
        'ул. Достоевского',
        'ул. Булгакова',
        'ул. Лермонтова',
        'ул. Гоголя',
        'ул. Чернышевского',
        'ул. Белинского',
        'ул. Грибоедова',
        'ул. Островского',
        'ул. Чайковского',
        'ул. Римского-Корсакова',
        'ул. Глинки',
        'ул. Рахманинова',
    ];

    public $transport = [
        'автобус',
        'троллейбус',
        'трамвай',
        'маршрутка'
    ];

    /**
     *
     */
    protected function getRandomElement(array $arr)
    {
        $n = count($arr) - 1;
        $i = rand(0, $n);
        return $arr[$i];

    }


    /**
     *
     */
    public function getRandomStreet()
    {
        return $this->getRandomElement($this->streets);
    }

    /**
     *
     */
    public function getRandomTransportName()
    {
        return $this->getRandomElement($this->transport);
    }

    /**
     *
     */
    public function getRandomNumber()
    {
        return rand(1, 100);
    }

    /**
     *
     */
    public function getRandomRecord()
    {
        return [
            'name' => $this->getRandomTransportName(),
            'number' => $this->getRandomNumber(),
            'event_time' => time(),
            'direction' => $this->getRandomStreet(),
            'handle' => false
        ];
    }
}