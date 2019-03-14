# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-flash.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-flash)
[![Build Status](https://img.shields.io/travis/spatie/laravel-flash/master.svg?style=flat-square)](https://travis-ci.org/spatie/laravel-flash)
[![Code coverage](https://scrutinizer-ci.com/g/spatie/laravel-flash/badges/coverage.png)](https://scrutinizer-ci.com/g/spatie/laravel-flash)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie/laravel-flash.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie/laravel-flash)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-flash.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-flash)

This is a small, simple package to send flash messages in Laravel apps.  A flash message is a message that is carried over the next request.

This is how it can be used:

```php
class MyController
{
    public function store()
    {
        // …

        flash(__('Post saved!'), 'my-class');

        return redirect()->to();
    }
}
```

In your view you can do this:

```blade
@if(flash())
    <div class="{{ flash()->class }}">
        {{ flash()->message }}
    </div>
@endif
```

## Installation

You can install the package via composer:

```bash
composer require spatie/laravel-flash
```

## Usage

``` php
$skeleton = new Spatie\Skeleton();
echo $skeleton->echoPhrase('Hello, Spatie!');
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Postcardware

You're free to use this package, but if it makes it to your production environment we highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: Spatie, Samberstraat 69D, 2060 Antwerp, Belgium.

We publish all received postcards [on our company website](https://spatie.be/en/opensource/postcards).

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## Support us

Spatie is a webdesign agency based in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

Does your business depend on our contributions? Reach out and support us on [Patreon](https://www.patreon.com/spatie). 
All pledges will be dedicated to allocating workforce on maintenance and new awesome stuff.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
