<?php
/**
 * Created by PhpStorm.
 * User: hanson
 * Date: 16-5-19
 * Time: 上午2:39
 */

namespace Hanccc;


interface DetailInterface
{
    /**
     * @param $url string
     * @return bool
     */
    public function isDetailUrl($url);
    
    public function handle();

}