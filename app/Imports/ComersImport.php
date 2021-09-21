<?php

namespace App\Imports;

use App\Models\Comer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ComersImport implements ToModel, WithStartRow
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
        return new Comer([
            'id_number' => $row[1],
            'name' => $row[2],
            'gender' => $row[3],
            'arrival' => $row[4],
            'resident_id' => $row[5]
        ]);
    }
}
