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

    public $detailUrls = [];

    /** @var  $detailCrawler DetailCrawler */
    public $detailCrawler;

    public function __construct()
    {
        set_time_limit(0);
        $args = func_get_args();
        $argNum = func_num_args();
        $this->client = new Client();
        $this->logPath = $argNum == 1 ? $args[0] : $args[1];
        $this->crawl($argNum == 1 ? $this->url : $args[0]);
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

    protected function iterateUrls()
    {
        for ($i = 0; $i < $this->getMaxPage(); $i++) {
            $url = $this->getEachPageUrl($i);
            $this->crawl($url);
            $this->crawlDetailUrl();
        }
    }

    protected function crawlDetailUrl()
    {
        $this->crawler->filter('a')->each(function ($node) {
            $url = $node->link()->getUri();

            if ($this->detailCrawler->isDetailUrl($url) && !in_array($url, $this->detailUrls)) {
                $this->detailUrls[] = $url;
                $this->detailCrawler->start($url);
            }

        });
    }

    protected function getMaxPage()
    {
        if ($this->maxPage < 1)
            throw new \Exception('最大页数不能小于1');

        return $this->maxPage;
    }

}
