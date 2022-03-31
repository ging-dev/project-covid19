<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VaccinationStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'number_injected',
        'note',
        'user_id',
    ];

    /**
     * @return BelongsTo<User, VaccinationStatus>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
