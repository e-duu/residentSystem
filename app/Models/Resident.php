<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_number',
        'email',
        'gender',
        'place_of_birth',
        'born_date',
        'religion',
        'education',
        'type_of_work',
        'marital_status',
        'address',
        'rt',
        'rw',
        'village',
        'contact',
    ];

    public function family_cards()
    {
        return $this->hasMany(FamilyCard::class);
    }

    public function comers()
    {
        return $this->hasMany(Comer::class);
    }

    public function dies()
    {
        return $this->hasMany(Death::class);
    }

    public function moves()
    {
        return $this->hasMany(Move::class);
    }

    public function members()
    {
        return $this->hasMany(Member::class, 'id');
    }

    protected $appends = [
        'age'
    ];

    public function getAgeAttribute()
    {
        $bornDate = $this->born_date;

        $currentDate = date("d-m-Y");

        $age = date_diff(date_create($bornDate), date_create($currentDate));

        return (int)$age->format("%y");
    }
}
