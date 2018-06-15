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

    public function getSettingValue($key, $cast_type = null)
    {
        $value = optional($this->getSetting($key))->value;

        if(is_null($value))
            return null;

        switch(($cast_type) ?: $this->getSetting($key)->cast_type) {

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

    public function newSetting($key, $value = null, $cast_type = 'string')
    {
        $setting = $this->getSetting($key);

        if(!is_null($cast_type) && !in_array($cast_type, ['integer', 'int', 'boolean', 'bool', 'string', 'flat', 'double']))
            $cast_type = 'string';

        if($setting)
            return $this->updateSetting($key, $value, $cast_type);

        $model = config('eloquent-settings.model');

        return $this->settings()->save(new $model([
            'key' => $key,
            'value' => $value,
            'cast_type' => (!is_null($cast_type)) ? $cast_type : 'string',
        ]));
    }

    public function updateSetting($key, $newValue = null, $cast_type = null)
    {
        $setting = $this->settings()->where('key', $key)->first();

        if(!is_null($cast_type) && !in_array($cast_type, ['integer', 'int', 'boolean', 'bool', 'string', 'flat', 'double']))
            $cast_type = 'string';

        if(!$setting)
            return $this->newSetting($key, $newValue, $cast_type);

        $setting->update([
            'value' => $newValue,
            'cast_type' => (!is_null($cast_type)) ? $cast_type : $setting->cast_type,
        ]);

        return $this->settings()->where('key', $key)->first();
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
