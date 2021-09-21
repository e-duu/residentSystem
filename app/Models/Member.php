<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'family_card_id',
        'resident_id',
        'connection'
    ];

    public function residents()
    {
        return $this->belongsTo(Resident::class, 'resident_id', 'id');
    }

    public function family_cards()
    {
        return $this->belongsTo(FamilyCard::class, 'family_card_id', 'id');
    }
}
