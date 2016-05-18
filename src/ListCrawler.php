<?php
/**
 * Created by PhpStorm.
 * User: hanson
 * Date: 16-5-19
 * Time: 上午2:03
 */

namespace Hanccc;


abstract class ListCrawler extends Crawler implements ListInterface
{

    public $maxPage;

    /** @var  $detailCrawler DetailCrawler */
    public $detailCrawler;

    public function setDetailCrawler(DetailCrawler $detailCrawler){
        $this->detailCrawler = $detailCrawler;
    }

    public function iterateUrls()
    {
        for ($i = 0; $i < $this->getMaxPage(); $i++){
            $url = $this->getEachPageUrl($i);
            $this->crawl($url);
            $this->crawlDetailUrl();
        }
    }

    public function crawlDetailUrl()
    {
        $this->crawler->filter('a')->each(function ($node){
            if($this->detailCrawler->isDetailUrl($node->link()->getUri())){
                
            }
        });
    }

    public function getMaxPage()
    {
        if($this->maxPage < 1)
            throw new \Exception('最大页数不能小于1');

        return $this->maxPage;
    }

}