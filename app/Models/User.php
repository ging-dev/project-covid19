<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property int $id
 * @property string $uid
 * @property string $first_name
 * @property string $last_name
 * @property string $full_name
 * @property string $photo
 */
class User extends Authenticatable
{
    protected $fillable = [
        'uid',
        'first_name',
        'last_name',
        'photo',
        'remember_token',
    ];

    /** @var string[] */
    protected $hidden = ['remember_token'];

    public function fullName(): Attribute
    {
        return new Attribute(
            fn (): string => $this->last_name.' '.$this->first_name,
        );
    }
}
