<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int $id
 * @property string $uid
 * @property string $name
 * @property string $photo
 */
class User extends Authenticatable
{
    /** @var array */
    protected $fillable = ['id', 'uid', 'name', 'photo'];

    /** @var array */
    protected $guarded = [];
}
