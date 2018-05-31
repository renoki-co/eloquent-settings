<?php

namespace Rennokki\Settings\Traits;

trait HasSettings {

    public function settings()
    {
        return $this->morphMany(config('eloquent-settings.model'), 'model');
    }

    public function getSetting($key)
    {
        return $this->settings()->where('key', $key)->first();
    }

    public function getSettingValue($key, $cast = 'string')
    {
        $value = optional($this->getSetting($key))->value;

        if(is_null($value))
            return null;

        switch($cast) {

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
                return $value;
                break;

        }
    }

    public function newSetting($key, $value = null)
    {
        $setting = $this->getSetting($key);

        if($setting)
            return $this->updateSetting($key, $value);

        $model = config('eloquent-settings.model');

        return $this->settings()->save(new $model([
            'key' => $key,
            'value' => $value,
        ]));
    }

    public function updateSetting($key, $newValue = null)
    {
        $setting = $this->settings()->where('key', $key)->first();

        if(!$setting)
            return false;

        $setting->update([
            'value' => $newValue,
        ]);

        return $setting;
    }

    public function deleteSetting($key)
    {
        $setting = $this->settings()->where('key', $key)->first();

        if(!$setting)
            return false;

        return (bool) $setting->delete();
    }

    public function deleteSettings()
    {
        return (bool) $this->settings()->delete();
    }

}
