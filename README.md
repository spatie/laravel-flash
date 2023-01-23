# A lightweight package to flash messages

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-flash.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-flash)
![run-tests](https://github.com/spatie/laravel-flash/workflows/run-tests/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-flash.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-flash)

This is a lightweight package to send flash messages in Laravel apps.  A flash message is a message that is carried over to the next request by storing it in the session. This package only supports one single flash message at a time.

This is how it can be used:

```php
class MySpecialSnowflakeController
{
    public function store()
    {
        // …

        flash('My message', 'my-class');

        return back();
    }
}
```

In your view you can do this:

```blade
@if (flash()->message)
    <div class="{{ flash()->class }}">
        {{ flash()->message }}
    </div>
@endif
```

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-flash.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-flash)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require spatie/laravel-flash
```

## Usage

Here is an example on how to flash a message.

```php
class MyController
{
    public function store()
    {
        // …

        flash('My message');

        return back();
    }
}
```

In your view you can use it like this

```blade
@if(flash()->message)
    <div>
        {{ flash()->message }}
    </div>
@endif
```

### Using a class name to style the displayed message

You can add a class as the second parameter. This is typically used to style the output in your HTML.

```php
class MyController
{
    public function store()
    {
        // …

        flash('My message', 'my-class');

        return back();
    }
}
```

In your view you can use the class like this:

```blade
@if (flash()->message)
    <div class="{{ flash()->class }}">
        {{ flash()->message }}
    </div>
@endif
```

You can also set an array of classes. These will be output by `flash()->class` by imploding the array with a space-delimiter.

```php
flash('My message', ['my-class', 'another-class']); // flash()->class output is: 'my-class another-class'
```

### Adding your own methods

If you don't want to specify a class each time you flash a message you can add a method name to `flash`.

The easiest way is by passing an array to the `levels` method. The key is the method name that should be added to `flash()`. The value is the class that will automatically be used when rendering the message.

```php
// this would probably go in a service provider

\Spatie\Flash\Flash::levels([
    'success' => 'alert-success',
    'warning' => 'alert-warning',
    'error' => 'alert-error',
]);
```

The above example will make these methods available on `flash`:

```php
flash()->success('Hurray');
flash()->warning('Mayybeee');
flash()->error('Oh Oh');
```

The most likely scenario is that you want to consume the flash message in a view. You can use the `message`, `class` and `level` properties on the view.

```blade
@if (flash()->message)
    <div class="{{ flash()->class }}">
        {{ flash()->message }}
    </div>

    @if(flash()->level === 'error')
        This was an error.
    @endif
@endif
```

Additionally, when you've added your own method, you can also pass that method name as a second parameter to `flash` itself:

```php
flash('Hurray', 'success'); // `flash()->class` will output 'alert-success'
```

You can also add a method to `flash` by using `macro`.

Here's an example:

```php
// this would probably go in a service provider

use Spatie\Flash\Message;

\Spatie\Flash\Flash::macro('warning', function (string $message) {
    return $this->flashMessage(new Message($message, 'alert alert-warning'));
});
```

You can now use a `warning` method on `flash`:

```php
flash()->warning('Look above you!');
```

You can pass the desired `level` as the third argument to `Message`.

```php
// in a service provider
use Spatie\Flash\Message;

\Spatie\Flash\Flash::macro('warning', function (string $message) {
    return $this->flashMessage(new Message($message, 'alert alert-warning', 'my-level'));
});

// in the next request, after having flashed a message 
flash()->level; // returns `my-level`
```

## Alternatives

This package is intended to be lightweight. If you need things like multiple messages, support for Bootstrap, overlays, ... take a look at [this excellent flash package](https://github.com/laracasts/flash) by [Jeffrey Way](https://github.com/JeffreyWay) or [Laraflash](https://github.com/coderello/laraflash) by [Ilya Sakovich](https://github.com/hivokas).

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

### Security

If you've found a bug regarding security please mail [security@spatie.be](mailto:security@spatie.be) instead of using the issue tracker.

## Postcardware

You're free to use this package, but if it makes it to your production environment we highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: Spatie, Kruikstraat 22, 2018 Antwerp, Belgium.

We publish all received postcards [on our company website](https://spatie.be/en/opensource/postcards).

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
