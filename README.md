# crawler

A easy package to crawl a site list and detail

## Installation

```
composer require hanccc/crawler
```

## usage

This package require [Goutte](https://github.com/FriendsOfPHP/Goutte), you can get the dom by ```$this->crawler();``` in both of list and detail.

### ListCrawler
list extend Hanccc/ListCrawler

```
    //return links per page
    public function getEachPageUrl($page);
```
```
    // get the maximum number of pages
    public function setMaxPage()
    {
        $this->maxPage = $num;
    }
```

### DetailCrawler
detail extend Hanccc/DetailCrawler

```
    //Returns whether URL parameters detail page
    public function isDetailUrl($url);
```
```
    // what you want to do about the detail page
    public function handle()
    {
        echo $this->crawler->filter('title')->text();
    }
```


## License

Crawler is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
