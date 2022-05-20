<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @var list<string> */
    protected $fillable = [
        'uid',
        'first_name',
        'last_name',
        'photo',
        'remember_token',
    ];

    /**
     * @var list<string>
     */
    protected $hidden = ['remember_token'];

    /**
     * @return Attribute<callable(): string, null>
     */
    public function fullName(): Attribute
    {
        return new Attribute(
            fn (): string => $this->last_name.' '.$this->first_name,
        );
    }
}
