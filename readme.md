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

$user->settings(); // Return the relationship.

$user->getSetting('subscribed_to_newsletter'); // Return the value of the subscribed_to_newsletter setting.
$user->getValue('subscribed_to_newsletter'); // Alias to getSetting().

$user->newSetting('subscribed_to_newsletter', 1); // Create a new setting; if it does exist, it is updated.
$user->updateSetting('subscribed_to_newsletter', 0); // Update the setting.
$user->deleteSetting('subscribed_to_newsletter'); // Delete the setting.

$user->deleteSettings(); // Delete all settings.
```