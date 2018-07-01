[![Build Status](https://travis-ci.org/rennokki/eloquent-settings.svg?branch=master)](https://travis-ci.org/rennokki/eloquent-settings)
[![codecov](https://codecov.io/gh/rennokki/eloquent-settings/branch/master/graph/badge.svg)](https://codecov.io/gh/rennokki/eloquent-settings/branch/master)
[![StyleCI](https://github.styleci.io/repos/135289030/shield?branch=master)](https://github.styleci.io/repos/135289030)
[![Latest Stable Version](https://poser.pugx.org/rennokki/eloquent-settings/v/stable)](https://packagist.org/packages/rennokki/eloquent-settings)
[![Total Downloads](https://poser.pugx.org/rennokki/eloquent-settings/downloads)](https://packagist.org/packages/rennokki/eloquent-settings)
[![Monthly Downloads](https://poser.pugx.org/rennokki/eloquent-settings/d/monthly)](https://packagist.org/packages/rennokki/eloquent-settings)
[![License](https://poser.pugx.org/rennokki/eloquent-settings/license)](https://packagist.org/packages/rennokki/eloquent-settings)

[![Beerpay](https://beerpay.io/rennokki/eloquent-settings/badge.svg?style=beer-square)](https://beerpay.io/rennokki/eloquent-settings)  [![Beerpay](https://beerpay.io/rennokki/eloquent-settings/make-wish.svg?style=flat-square)](https://beerpay.io/rennokki/eloquent-settings?focus=wish)

# Eloquent Settings
Eloquent Settings allows binding settings (key-pair values) to any eloquent model via a trait.

# Installation

Install the package:

```bash
$ composer require rennokki/eloquent-settings
```

If your Laravel version does not support package discovery, add the following line in the `providers` array in the `config/app.php` file:

```php
Rennokki\Settings\SettingsServiceProvider::class,
```

Publish the config file & migration files:

```bash
$ php artisan vendor:publish
```

Migrate the database:

```bash
$ php artisan migrate
```

Then you can add the `HasSettings` trait to your Eloquent model:

```php
use Rennokki\Settings\Traits\HasSettings;

class User extends Model {
    use HasSettings;
    ...
}
```

After that, there are simple methods that can be used from the model:

```php
$user = User::find(1);

// Return the relationship containing all the settings.
$user->settings();

// Return the model instance of the setting.
// If the setting doesn't exist, returns null.
$user->getSetting('subscribed_to_newsletter'); 

// Returns the value, in 'string' cast type.
// If it doesn't exist, returns null.
$user->getSettingValue('subscribed_to_newsletter');

// Gets the value, but in cast mode.
// This will return a boolean (true/false)
$user->getSettingValue('subscribed_to_newsletter', 'bool');

// Available casts: string (by default), integer, int, boolean, bool, flat, double.
// Any other cast type will return the default cast (string)

// Create a new setting.
// If it does exist, it is updated.
// Returns a model instance.
$user->newSetting('subscribed_to_newsletter', 1);
$user->newSetting('subscribed_to_newsletter', true);

// Update the setting.
// Returns a model instance.
$user->updateSetting('subscribed_to_newsletter', 0);
$user->updateSetting('subscribed_to_newsletter', false);


// By default, the variable has its cast to 'string'.
// You can set the cast for set & update too.
// Next time, you can simply call getSettingValue() and it will retrieve
// the cast it was previously stored.
$user->newSetting('subscribed_to_newsletter', 1, 'boolean');
$user->getSettingValue('subscribed_to_newsletter'); // (boolean) true
$user->getSettingValue('subscribed_to_newsletter', 'integer'); // (integer) 1

$user->updateSetting('subscribed_to_newsletter', 0, 'integer');
$user->getSettingValue('subscribed_to_newsletter', 'integer'); // (integer) 1
$user->getSettingValue('subscribed_to_newsletter', 'boolean'); // (boolean) false

// When updating, you may not give a third parameter. In that case, the cast remains the same
// as previously set.

// Delete the setting.
// Returns true/false (true if deleted)
$user->deleteSetting('subscribed_to_newsletter');

 // Delete all settings.
 // Returns true/false (true if deleted)
$user->deleteSettings();
```
