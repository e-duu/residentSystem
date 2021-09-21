<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'family_card_number',
        'address',
        'rt',
        'rw',
        'village'
    ];

    protected $hidden = [];

    public function residents()
    {
        return $this->belongsTo(Resident::class, 'id');
    }

    public function members()
    {
        return $this->hasMany(Member::class, 'id', 'family_card_id');
    }
}
