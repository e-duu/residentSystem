<?php

namespace App\Imports;

use App\Models\Resident;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class ResidentsImport implements ToModel,WithStartRow
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
        return new Resident([
            'name' => $row[1],
            'id_number' => $row[2],
            'email' => $row[3],
            'gender' => $row[4],
            'place_of_birth' => $row[5],
            'born_date' => $row[6],
            'religlion' => $row[7],
            'education' => $row[8],
            'type_of_work' => $row[9],
            'marital_status' => $row[10],
            'address' => $row[11],
            'rt' => $row[12],
            'rw' => $row[13],
            'village' => $row[14],
            'contact' => $row[15],
        ]);
    }
}
