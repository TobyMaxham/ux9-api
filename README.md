# UX9 URL Shortener API
Official UX9 URL Shortener API

[![Total Downloads](https://poser.pugx.org/TobyMaxham/url-shortener/downloads.svg)](https://packagist.org/packages/TobyMaxham/url-shortener)
[![Latest Stable Version](https://poser.pugx.org/TobyMaxham/url-shortener/v/stable.svg)](https://packagist.org/packages/TobyMaxham/url-shortener)
[![Latest Unstable Version](https://poser.pugx.org/TobyMaxham/url-shortener/v/unstable.svg)](https://packagist.org/packages/TobyMaxham/url-shortener)
[![License](https://poser.pugx.org/TobyMaxham/url-shortener/license.svg)](https://packagist.org/packages/TobyMaxham/url-shortener)


## Installation 
```
composer require tobymaxham/url-shortener
```


## Usage

```php

$shorter = new TobyMaxham\Shortener('http://github.com');
$shorter->call()->out();

// or
$shorter->out('plain');
```


### Short Version
```php
$shorter = new TobyMaxham\Shortener();
$shorter->short('http://maxham.de');
```

You are using the Laravel Framework? Than try out [laravel-junkies/url-shortener](https://github.com/laravel-junkies/url-shortener).
It's an Laravel Package where you simply can use this:
```php
Shortener:short('http://example.com');
```


## Options
```php
// default = JSON, alternativ plain
$shorter->format($format);
$shorter->out($format);

// also
$shorter = new TobyMaxham\Shortener($url, $format);
```


