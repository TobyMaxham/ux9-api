[![UX9 URL Shortener API][tobymaxham-ux9-api-image]][tobymaxham-ux9-api-edit-link]

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tobymaxham/ux9-api.svg?style=flat-square)](https://packagist.org/packages/tobymaxham/ux9-api)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/tobymaxham/ux9-api.svg?style=flat-square)](https://packagist.org/packages/tobymaxham/ux9-api)
[![Support me on Patreon](https://img.shields.io/endpoint.svg?url=https%3A%2F%2Fshieldsio-patreon.vercel.app%2Fapi%3Fusername%3DTobymaxham%26type%3Dpatrons&style=flat)](https://patreon.com/Tobymaxham)

Official UX9 URL Shortener API. Visit [ux9.de](https://ux9.de/devs) for more Details.


## Installation

```ssh
composer require tobymaxham/ux9-api
```


## Usage

There are different ways how to get your short URL. If you are using Laravel than try out [laravel-junkies/url-shortener](https://github.com/laravel-junkies/url-shortener).
It's an Laravel Package where you simply can use this:
```php
$url = Shortener::short('https://example.com');
```

### Initialize
```php
$shortener = new TobyMaxham\Ux9\Shortener($url = null, $config = null, $format = 'json');

// set the API Token
$shortener->setToken('YOUR_API_TOKEN');
```
Where `$url` can be a valid URL or an array containing URL's. The `$format` is the output/return format you specified. If you don't enter a format it will take the specified format defined in the [configuration Array](#configuration) or the 'json' format.


### Get short URL
```php
$shortener->out();
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

```php
$config = [
    'API_TOKEN' => 'YOUR_API_TOKEN',
    'FORMAT' => 'plain',
];

$shortener = new TobyMaxham\Ux9\Shortener($url = null, $config);
```


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.


## Security Vulnerabilities

If you've found a bug regarding security please mail [git@maxham.de](mailto:git@maxham.de) instead of using the issue tracker.


## Support me

[![ko-fi](https://ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/Z8Z4NZKU)<br>
[![Support me on Patreon](https://img.shields.io/endpoint.svg?url=https%3A%2F%2Fshieldsio-patreon.vercel.app%2Fapi%3Fusername%3DTobymaxham%26type%3Dpatrons&style=flat)](https://patreon.com/Tobymaxham)


## Credits

- [TobyMaxham](https://github.com/TobyMaxham)
- [All Contributors](../../contributors)


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[tobymaxham-ux9-api-image]: https://socialify.git.ci/tobymaxham/ux9-api/image?description=1&font=Raleway&issues=1&language=1&owner=1&pattern=Charlie%20Brown&pulls=1&stargazers=1&theme=Light
[tobymaxham-ux9-api-edit-link]: https://socialify.git.ci/tobymaxham/ux9-api?description=1&font=Raleway&issues=1&language=1&owner=1&pattern=Charlie%20Brown&pulls=1&stargazers=1&theme=Light
