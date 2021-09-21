<?php

namespace App\Imports;

use App\Models\Dies;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DiesImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        return new Dies([
            'resident_id' => $row[1],
            'date_of_death' => $row[2],
            'reason' => $row[3]
        ]);
    }
}
