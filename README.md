# UX9 URL Shortener API
Official UX9 URL Shortener API

[![Total Downloads](https://poser.pugx.org/TobyMaxham/url-shortener/downloads.svg)](https://packagist.org/packages/TobyMaxham/url-shortener)
[![Latest Stable Version](https://poser.pugx.org/TobyMaxham/url-shortener/v/stable.svg)](https://packagist.org/packages/TobyMaxham/url-shortener)
[![Latest Unstable Version](https://poser.pugx.org/TobyMaxham/url-shortener/v/unstable.svg)](https://packagist.org/packages/TobyMaxham/url-shortener)
[![License](https://poser.pugx.org/TobyMaxham/url-shortener/license.svg)](https://packagist.org/packages/TobyMaxham/url-shortener)


## Installation 
```ssh
composer require tobymaxham/url-shortener
```


## Usage

There are different ways how to get your short URL. If you are using Laravel than try out [laravel-junkies/url-shortener](https://github.com/laravel-junkies/url-shortener).
It's an Laravel Package where you simply can use this:
```php
$url = Shortener:short('http://example.com');
```

### Initialize
```php
$shortener = new TobyMaxham\Ux9\Shortener($url = NULL, $format = FALSE);
```
Where `$url` can be a valid URL or an array containing URL's. The `$format` is the output/return format you specified. If you don't enter a format it will take the specified format defined in the [config file](#configuration) or the 'json' format.


### Get short URL
```php
$shortener->out($format = NULL);
```


### Short Version
```php
$shortener->short('http://maxham.de');
$shortener->short('http://github.com');
```
Here you will always get the string of the short url.


### Options and parameters
```php
// default = json, alternativ plain, array
$shortener->format($format);
$shortener->out($format);
$shortener->add($url);
```

## Configuration

We have actually a bug in version v1.0. See [here](https://github.com/TobyMaxham/ux9-api/issues/4).
