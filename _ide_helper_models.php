<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Location
 *
 * @property int $id
 * @property string $name
 * @property int $death
 * @property int $treating
 * @property int $cases
 * @property int $recovered
 * @property int $cases_today
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location query()
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCases($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCasesToday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereDeath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereRecovered($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereTreating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereUpdatedAt($value)
 */
	class Location extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $uid
 * @property string $first_name
 * @property string $last_name
 * @property string $photo
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $full_name
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\VaccinationStatus
 *
 * @property int $id
 * @property string $name
 * @property string $phone_number
 * @property int $number_injected
 * @property string $note
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinationStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinationStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinationStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinationStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinationStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinationStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinationStatus whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinationStatus whereNumberInjected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinationStatus wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinationStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinationStatus whereUserId($value)
 */
	class VaccinationStatus extends \Eloquent {}
}

