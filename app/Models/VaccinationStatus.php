<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccinationStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'number_injected',
        'note',
    ];
}
