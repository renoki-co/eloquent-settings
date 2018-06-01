<?php

namespace Rennokki\Settings\Test\Models;

use Illuminate\Database\Eloquent\Model;

use Rennokki\Settings\Traits\HasSettings;

class User extends Model
{
    use HasSettings;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
