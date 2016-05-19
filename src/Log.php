<?php
/**
 * Created by PhpStorm.
 * User: hanson
 * Date: 16-5-19
 * Time: 下午12:45
 */

namespace Hanccc;


use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Log
{

    const ERROR = 1;
    const DEBUG = 2;

    static $logStatus = [
        self::ERROR => 'error',
        self::DEBUG => 'debug'
    ];
    
    static $instance;

    public static function getInstance($type, $path)
    {
        if (self::$instance)
            return self::$instance;

        self::$instance = new Logger(self::$logStatus[$type]);
        self::$instance->pushHandler(new StreamHandler($path . '/' . self::$logStatus[$type] . '.log', Logger::ERROR));
        return self::$instance;
    }
}