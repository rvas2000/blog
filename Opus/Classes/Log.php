<?php

namespace Opus;

class Log
{
	protected $fp = null;

    /**
     *	Сохраняет массив данных $data как запись в лог-файле
     */ 
	public function save(array $data = [])
	{
			$path = realpath(__DIR__ . '/../../') . '/site.log';
			$this->fp = fopen ($path, "a");

			$currDate = new \DateTime();
			$ip = $_SERVER['REMOTE_ADDR'];

			$msg = $currDate->format('d.m.Y H:i:s') . "\t" . $ip;

			foreach ($data as $key => $value) {
				if (! is_string ($value)) {
					$value = serialize($value);
				}

				$msg .= "\t" . $value;
			}	

			fwrite ($this->fp, $msg . PHP_EOL);
			fclose($this->fp);
	}
}