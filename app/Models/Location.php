<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    /** @var list<string> */
    protected $fillable = [
        'name',
        'death',
        'treating',
        'cases',
        'recovered',
        'cases_today',
    ];

    /** @var list<string> */
    protected $guarded = [];
}
