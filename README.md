Laravel Eloquent Settings
=========================

![CI](https://github.com/renoki-co/eloquent-settings/workflows/CI/badge.svg?branch=master)
[![codecov](https://codecov.io/gh/renoki-co/eloquent-settings/branch/master/graph/badge.svg)](https://codecov.io/gh/renoki-co/eloquent-settings/branch/master)
[![StyleCI](https://github.styleci.io/repos/135289030/shield?branch=master)](https://github.styleci.io/repos/135289030)
[![Latest Stable Version](https://poser.pugx.org/rennokki/eloquent-settings/v/stable)](https://packagist.org/packages/rennokki/eloquent-settings)
[![Total Downloads](https://poser.pugx.org/rennokki/eloquent-settings/downloads)](https://packagist.org/packages/rennokki/eloquent-settings)
[![Monthly Downloads](https://poser.pugx.org/rennokki/eloquent-settings/d/monthly)](https://packagist.org/packages/rennokki/eloquent-settings)
[![License](https://poser.pugx.org/rennokki/eloquent-settings/license)](https://packagist.org/packages/rennokki/eloquent-settings)

Eloquent Settings allows you to bind key-value pairs to any Laravel Eloquent model.

## 🤝 Supporting

If you are using one or more Renoki Co. open-source packages in your production apps, in presentation demos, hobby projects, school projects or so, spread some kind words about our work or sponsor our work via Patreon. 📦

You will sometimes get exclusive content on tips about Laravel, AWS or Kubernetes on Patreon and some early-access to projects or packages.

[<img src="https://c5.patreon.com/external/logo/become_a_patron_button.png" height="41" width="175" />](https://www.patreon.com/bePatron?u=10965171)

## 🚀 Installation

Install the package:

```bash
$ composer require rennokki/eloquent-settings
```

Publish the config:

```bash
$ php artisan vendor:publish --provider="Rennokki\Settings\SettingsServiceProvider" --tag="config"
```

Publish the migrations:

```bash
$ php artisan vendor:publish --provider="Rennokki\Settings\SettingsServiceProvider" --tag="migrations"
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
