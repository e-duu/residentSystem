<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
        'migration_date',
        'reason'
    ];
    
    public function residents()
    {
        return $this->belongsTo(Resident::class, 'resident_id');
    }
}
