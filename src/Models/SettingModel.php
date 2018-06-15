<?php

namespace Rennokki\Settings\Models;

use Illuminate\Database\Eloquent\Model;

class SettingModel extends Model
{
    protected $table = 'settings';
    protected $fillable = [
        'model_id', 'model_type', 'key', 'value', 'cast_type',
    ];

    public function model()
    {
        return $this->morphTo();
    }
}
