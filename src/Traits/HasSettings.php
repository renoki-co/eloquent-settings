<?php

namespace Rennokki\Settings\Traits;

trait HasSettings
{
    /**
     * Get the settings for this model.
     *
     * @return mixed
     */
    public function settings()
    {
        return $this->morphMany(config('eloquent-settings.model'), 'model');
    }

    /**
     * Get the setting by key.
     *
     * @param  string  $key
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getSetting(string $key)
    {
        return $this->settings()->where('key', $key)->first();
    }

    /**
     * Get the value of a setting by key and cast type. If no cast type is provided,
     * it will return using the cast stored in the database.
     *
     * @param  string  $key
     * @param  string  $castType
     * @return null|string|int|bool|float
     */
    public function getSettingValue(string $key, ?string $castType = null)
    {
        $setting = $this->getSetting($key);
        $value = optional($setting)->value;

        if (is_null($value)) {
            return null;
        }

        switch (($castType) ?: $setting->cast_type) {
            case 'string':
                return (string) $value;
            break;

            case 'integer':
            case 'int':
                return (int) $value;
            break;

            case 'boolean':
            case 'bool':
                return (bool) ((string) $value === '1' || (string) $value === 'true');
            break;

            case 'float':
            case 'double':
                return (float) $value;
            break;

            default:
                return (string) $value;
            break;
        }
    }

    /**
     * Set up a new setting. If the key exists, it updated it.
     *
     * @param  string  $key
     * @param  null|string|int|bool|float $value
     * @param  string  $castType
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function newSetting(string $key, $value = null, ?string $castType = 'string')
    {
        $castType = $this->validateCastType($castType);

        if ($setting = $this->getSetting($key)) {
            return $this->updateSetting($key, $value, $castType);
        }

        $model = config('eloquent-settings.model');

        return $this->settings()->save(new $model([
            'key'       => $key,
            'value'     => $value,
            'cast_type' => (! is_null($castType)) ? $castType : 'string',
        ]));
    }

    /**
     * Update a setting. If the key does not exist, it is added.
     *
     * @param  string  $key
     * @param  null|string|int|bool|float  $newValue
     * @param  string  $castType
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateSetting(string $key, $newValue = null, ?string $castType = null)
    {
        if (! $setting = $this->getSetting($key)) {
            return $this->newSetting($key, $newValue, $castType);
        }

        $castType = $this->validateCastType($castType);

        $setting->update([
            'value'     => $newValue,
            'cast_type' => (! is_null($castType)) ? $castType : $setting->cast_type,
        ]);

        return $setting;
    }

    /**
     * Delete a setting. If does not exist, returns null.
     *
     * @param  string  $key
     * @return bool
     */
    public function deleteSetting(string $key): bool
    {
        if (! $setting = $this->getSetting($key)) {
            return false;
        }

        return (bool) $setting->delete();
    }

    /**
     * Delete all the settings.
     *
     * @return bool
     */
    public function deleteSettings()
    {
        return (bool) $this->settings()->delete();
    }

    /**
     * Check if castType is a valid option, if not return string.
     *
     * @param  null  $castType
     * @return null|string
     */
    private function validateCastType($castType = null)
    {
        if (! is_null($castType) && ! in_array($castType,
                ['integer', 'int', 'boolean', 'bool', 'string', 'float', 'double'])) {
            return 'string';
        }

        return $castType;
    }
}
