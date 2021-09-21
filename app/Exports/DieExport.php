<?php

namespace App\Exports;

use App\Models\Dies;
use Maatwebsite\Excel\Concerns\FromCollection;

class DieExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Dies::all();
    }
}
