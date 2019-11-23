<?php

namespace Rennokki\Settings\Models;

use Illuminate\Database\Eloquent\Model;

class SettingModel extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $table = 'settings';

    /**
     * {@inheritdoc}
     */
    protected $guarded = [];

    /**
     * The model on which the setting is attached to.
     *
     * @return mixed
     */
    public function model()
    {
        return $this->morphTo();
    }
}
