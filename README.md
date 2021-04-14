# coding-standard

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)

This package provides the coding standard for our projects.

## Install

Via composer:

``` bash
$ composer require binsoul/coding-standard --dev
```               

## Usage

Install easy coding standard:
``` bash                 
$ composer require symplify/easy-coding-standard-prefixed --dev
```  

Check coding standard:
``` bash                 
$ vendor/bin/ecs check src tests --config vendor/binsoul/coding-standard/easy-coding-standard.php
```  

Install GrumPHP:
``` bash
$ composer require phpro/grumphp-shim --dev
```

Add GrumPHP configuration to composer.json:
``` json
{
    "extra": {
        "grumphp": {
            "config-default-path": "vendor/binsoul/coding-standard/grumphp.yaml"
        }
    }
}
```
## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/binsoul/net-hal-client.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/binsoul/net-hal-client
[link-author]: https://github.com/binsoul
