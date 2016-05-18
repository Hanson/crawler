<?php
/**
 * Created by PhpStorm.
 * User: hanson
 * Date: 16-5-18
 * Time: 下午7:25
 */

namespace Hanccc;


use GuzzleHttp\Client;

class Crawler
{
    public $crawler;
    
    public $client;

    public function __construct($url)
    {
        $this->client = new Client();
        $this->crawler = $this->client->request('get', $url);
    }

    public function crawl($url)
    {
        $this->crawler = $this->client->request('get', $url);
    }

}