Laravel Eloquent Settings
=========================

![CI](https://github.com/renoki-co/eloquent-settings/workflows/CI/badge.svg?branch=master)
[![codecov](https://codecov.io/gh/renoki-co/eloquent-settings/branch/master/graph/badge.svg)](https://codecov.io/gh/renoki-co/eloquent-settings/branch/master)
[![StyleCI](https://github.styleci.io/repos/135289030/shield?branch=master)](https://github.styleci.io/repos/135289030)
[![Latest Stable Version](https://poser.pugx.org/rennokki/eloquent-settings/v/stable)](https://packagist.org/packages/rennokki/eloquent-settings)
[![Total Downloads](https://poser.pugx.org/rennokki/eloquent-settings/downloads)](https://packagist.org/packages/rennokki/eloquent-settings)
[![Monthly Downloads](https://poser.pugx.org/rennokki/eloquent-settings/d/monthly)](https://packagist.org/packages/rennokki/eloquent-settings)
[![License](https://poser.pugx.org/rennokki/eloquent-settings/license)](https://packagist.org/packages/rennokki/eloquent-settings)

[![PayPal](https://img.shields.io/badge/PayPal-donate-blue.svg)](https://paypal.me/rennokki)

Eloquent Settings allows you to bind key-value pairs to any Laravel Eloquent model.

## 🤝 Supporting

Renoki Co. on GitHub aims on bringing a lot of open source, MIT-licensed projects and helpful projects to the world. Developing and maintaining projects everyday is a harsh work and tho, we love it.

If you are using your application in your day-to-day job, on presentation demos, hobby projects or even school projects, spread some kind words about our work or sponsor our work. Kind words will touch our chakras and vibe, while the sponsorships will keep the open source projects alive.

## 🚀 Installation

Install the package:

```bash
$ composer require rennokki/eloquent-settings
```

Publish the config file & migration files:

```bash
$ php artisan vendor:publish
```

Migrate the database:

```bash
$ php artisan migrate
```

## 🙌 Usage

You can add the `HasSettings` trait to any Eloquent model:

```php
use Rennokki\Settings\Traits\HasSettings;

class User extends Model {
    use HasSettings;
    ...
}
```

## Adding settings

```php
$user->newSetting('subscribed.to.newsletter', 1);
$user->newSetting('subscribed.to.newsletter', true);
```

By default, settings' values are stored as `string`. Later, if you try to get them with cast, they will return the value you have initially stored.
If you store 'true' as a string, if you cast it to a boolean, you'll get `true`.

If you plan to store it with cast type other than `string`, you can pass an additional third parameter that can be either `string`, `boolean`, `bool`, `int`, `integer`, `float` or `double`.

```php
$user->newSetting('subscribed.to.newsletter', true, 'bool');
```

## Updating settings

Updating settings can be either to values, cast types or both, depending on what has changed.

```php
$user->updateSetting('subscribed.to.newsletter', false, 'bool');
```

If you don't specify a cast parameter, it will not change, only the value will change, or viceversa.

## Getting settings & values

You can get the Setting instance, not the value using `getSetting()`:

```php
$user->getSetting('subscribed.to.newsletter'); // does not accept a cast
```

If you plan to get the value, you can use `getSettingValue()`:

```php
$user->getSettingValue('subscribed.to.newsletter'); // true, as boolean
$user->getSettingValue('subscribed.to.newsletter', 'int'); // 1, as integer
```

Remember, when you update or create a new setting, the cast type is stored. By default, next time you don't have to call the cast parameter again because it will cast it the way it was specified on storing.

```php
$user->newSetting('is.cool', true, 'bool');
$user->getSettingValue('is.cool'); // it returns true as boolean
```

Getting values of not-known settings keys, you will return `null`.

```php
$user->getSettingValue('subscribed.to.weekly.newsletter'); // null
```

## Deleting a setting

Deleting settings from the database can be done using `deleteSetting()`.

```php
$user->deleteSetting('subscribed.to.newsletter');
```

To delete all settings, call `deleteSettings()`.

```php
$user->deleteSettings();
```

## 🐛 Testing

``` bash
vendor/bin/phpunit
```

## 🤝 Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## 🔒  Security

If you discover any security related issues, please email alex@renoki.org instead of using the issue tracker.

## 🎉 Credits

- [Alex Renoki](https://github.com/rennokki)
- [All Contributors](../../contributors)

## 📄 License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
