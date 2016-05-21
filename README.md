# crawler

A easy package to crawl a site list and detail

## Installation

```
composer require hanccc/crawler
```

## usage

This package require [Goutte](https://github.com/FriendsOfPHP/Goutte), you can get the dom by ```$this->crawler();``` in both of list and detail.

### example

```
        //or $listCrawler = new ExampleListCrawler(storage_path('logs'));
        $listCrawler = new ExampleListCrawler('http://example.com', storage_path('logs'));
        $listCrawler->setDetailCrawler(new ExampleDetailCrawler());
        $listCrawler->start();
```

#### ListCrawler


```
class ExampleListCrawler extends ListCrawler{
    public $url = 'http://example.com';
    
    //return links per page
    public function getEachPageUrl($page)
    {
        return 'http://example.com/list&page=' . $page;
    }
    
    // get the maximum number of pages
    public function setMaxPage()
    {
        $this->maxPage = $num;
    }
}

```

#### DetailCrawler

```
class ExampleDetailCrawler extends DetailCrawler{

    //Returns boolean
    public function isDetailUrl($url)
    {
        if(preg_match('/example.com\/id(\d+)/, $url))
            return true;
    }
    
    // what you want to do about the detail page
    public function handle()
    {
        echo $this->crawler->filter('title')->text();
    }
}
```


## License

Crawler is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
