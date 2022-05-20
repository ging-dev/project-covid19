<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @var array<array-key, string> */
    protected $fillable = [
        'uid',
        'first_name',
        'last_name',
        'photo',
        'remember_token',
    ];

    /**
     * @psalm-suppress NonInvariantDocblockPropertyType
     * @var array<int, string>
     */
    protected $hidden = ['remember_token'];

    /**
     * @psalm-suppress TooManyTemplateParams
     * @return Attribute<callable(): string, null>
     */
    public function fullName(): Attribute
    {
        return new Attribute(
            fn (): string => $this->last_name.' '.$this->first_name,
        );
    }
}
