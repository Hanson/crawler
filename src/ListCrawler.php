<?php
/**
 * Created by PhpStorm.
 * User: hanson
 * Date: 16-5-19
 * Time: 上午2:03
 */

namespace Hanccc;


use Goutte\Client;

abstract class ListCrawler implements ListInterface
{
    use Crawler;
    
    public $client;

    public $maxPage;

    /** @var  $detailCrawler DetailCrawler */
    public $detailCrawler;

    public function __construct($url, $logPath)
    {
        $this->client = new Client();
        $this->logPath = $logPath;
        $this->crawl($url);
    }

    public function setDetailCrawler(DetailCrawler $detailCrawler)
    {
        $this->detailCrawler = $detailCrawler;
    }

    public function start()
    {
        $this->setMaxPage();
        
        $this->iterateUrls();
    }

    private function iterateUrls()
    {
        for ($i = 0; $i < $this->getMaxPage(); $i++) {
            $url = $this->getEachPageUrl($i);
            $this->crawl($url);
            $this->crawlDetailUrl();
        }
    }

    private function crawlDetailUrl()
    {
        $this->crawler->filter('a')->each(function ($node) {
            $url = $node->link()->getUri();

            if ($this->detailCrawler->isDetailUrl($url)) {
                $this->detailCrawler->start($url);
            }

        });
    }

    private function getMaxPage()
    {
        if ($this->maxPage < 1)
            throw new \Exception('最大页数不能小于1');

        return $this->maxPage;
    }

}