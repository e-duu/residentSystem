<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dies extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
        'date_of_death',
        'name',
        'reason'
    ];

    public function residents()
    {
        return $this->belongsTo(Resident::class, 'resident_id');
    }
}
