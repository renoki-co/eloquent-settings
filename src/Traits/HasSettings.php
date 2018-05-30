<?php

namespace Rennokki\Settings\Traits;

trait HasSettings {

    public function settings()
    {
        return $this->morphMany(config('eloquent-settings.model'), 'model');
    }

    public function getSetting($key)
    {
        return optional($this->settings()->where('key', $key)->first())->value;
    }

    public function getValue($key)
    {
        return $this->getSetting($key);
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

        return $setting->delete();
    }

    public function deleteSettings()
    {
        return $this->settings()->delete();
    }

}