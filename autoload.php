<?php
spl_autoload_register(function ($className) {
    $elements = array_values(array_filter(explode('\\', $className), function ($v) {return ! empty($v); }));
 
    $baseDir = __DIR__;

    $fullPath = false;

    if (count($elements) > 1) {
        if ($elements[0] === 'Opus') {
            if ($elements[1] === 'App') {
                $fullPath = realpath($baseDir . '/' . implode('/', $elements) . '.php');
            } else {
                unset($elements[0]);
                $fullPath = realpath($baseDir . '/Opus/Classes/' . implode('/', $elements) . '.php');
            }
        }
    } else {       
        if (preg_match('/Controller$/', $elements[0])) {
            $fullPath = realpath($baseDir . '/Site/controllers/' . implode('/', $elements) . '.php');
        } elseif (preg_match('/Service$/', $elements[0])) {
            $fullPath = realpath($baseDir . '/Site/services/' . implode('/', $elements) . '.php');
        }
    }


    if ($fullPath !== false) {require_once $fullPath;}
});