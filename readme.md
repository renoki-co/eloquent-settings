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

// Delete the setting.
// Returns true/false (true if deleted)
$user->deleteSetting('subscribed_to_newsletter');

 // Delete all settings.
 // Returns true/false (true if deleted)
$user->deleteSettings();
```
