<?php

/**
 * Created by PhpStorm.
 * User: hanson
 * Date: 16-5-19
 * Time: 上午3:04
 */


require_once __DIR__ . './../vendor/autoload.php';

class YgdyListCrawler extends \Hanccc\ListCrawler
{

    public $url = 'http://www.ygdy8.net/html/gndy/dyzz/';

    /**
     * @param $page int
     * @return string
     */
    public function getEachPageUrl($page)
    {
        return 'http://www.ygdy8.net/html/gndy/dyzz/list_23_' . $page . '.html';
    }

    public function setMaxPage()
    {
        if(preg_match('/共(\d+)页/', $this->crawler->filter('.co_content8 .x')->text(), $match))
            $this->maxPage = $match[1];
    }
}
class YgdyDetailCrawler extends \Hanccc\DetailCrawler
{

    /**
     * @param $url string
     * @return bool
     */
    public function isDetailUrl($url)
    {
        return preg_match('/gndy\/dyzz\/(\d+)\/(\d+).html/', $url);
    }

    public function handle()
    {
        echo $this->crawler->filter('title')->text().PHP_EOL;
    }
}

class Example
{
    function test(){
        $listCrawler = new YgdyListCrawler(__DIR__ . '/');
        $listCrawler->setDetailCrawler(new YgdyDetailCrawler());
        $listCrawler->start();
    }

}

$test = new Example();
$test->test();
