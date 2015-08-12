# UX9 URL Shortener API
Official UX9 URL Shortener API


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


## Options
```php
// default = JSON, alternativ plain
$shorter->format($format);
$shorter->out($format);

// also
$shorter = new TobyMaxham\Shortener($url, $format);
```
