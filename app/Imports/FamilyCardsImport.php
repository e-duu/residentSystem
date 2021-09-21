<?php

namespace App\Imports;

use App\Models\FamilyCard;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class FamilyCardsImport implements ToModel, WithStartRow
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
        return new FamilyCard([
            'family_card_number' => $row[1],
            'address' => $row[2],
            'rt' => $row[3],
            'rw' => $row[4],
            'village' => $row[5]
        ]);
    }
}
