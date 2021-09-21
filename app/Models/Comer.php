<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_number',
        'name',
        'gender',
        'arrival',
        'resident_id'
    ];

    public function residents()
    {
        return $this->belongsTo(Resident::class, 'resident_id');
    }
}
