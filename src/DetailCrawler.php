<?php
/**
 * Created by PhpStorm.
 * User: hanson
 * Date: 16-5-19
 * Time: 上午2:05
 */

namespace Hanccc;


use Goutte\Client;

abstract class DetailCrawler implements DetailInterface
{
    use Crawler;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function start($url)
    {
        $this->crawl($url);

        $this->handle();
    }

}