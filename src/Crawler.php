<?php


namespace Hanson\Crawler;


use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Crawler
{

    protected $client;

    protected $config;

    protected $pageNum;

    protected $currentUrl;

    public $currentContent;

    protected $eachListCallback;

    public function __construct(array $config)
    {
        $this->config = $config;

        $this->client = new Client([
//            'timeout' => 2,
        ]);

        echo 'ready';
        print_r($this->crawl($config['url']));
        echo 'finish';
    }

    /**
     * @throws CrawlerException
     */
    public function run()
    {
        if (!$this->pageNum && is_int($this->pageNum)) {
            throw new CrawlerException('页数不正确');
        }

        for ($page = 0; $page < $this->pageNum; $page++) {
            $url = $this->getEachListUrl($page);

            echo $url . PHP_EOL;
//            $this->crawl($url);
//            $this->crawlDetailUrl();
        }
    }

    public function crawl($url)
    {
        echo $url;
        try{
            $this->currentUrl = $url;

            $response = $this->client->request('get', $url);
        } catch (GuzzleException $e) {
            print_r($e->getMessage());
            return null;
        }

        $this->currentContent = (string) $response->getBody();

        $response->getBody()->close();

        return $this->currentContent;
    }

    /**
     * 设置总页数
     *
     * @param Closure $callback
     */
    public function setPageNum(Closure $callback)
    {
        $this->pageNum = $callback($this);

        echo $this->pageNum;
    }

    public function getEachListUrl($page)
    {
        return call_user_func($this->eachListCallback, [$page]);
    }

    public function setEachListUrl(Closure $callback)
    {
        return $this->eachListCallback = $callback;
    }

}