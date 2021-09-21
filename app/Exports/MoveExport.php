<?php

namespace App\Exports;

use App\Models\Move;
use Maatwebsite\Excel\Concerns\FromCollection;

class MoveExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Move::all();
    }
}
