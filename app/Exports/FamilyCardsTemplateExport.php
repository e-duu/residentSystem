<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FamilyCardsTemplateExport implements FromArray, WithHeadings
{
    /**
     * @return array
     */
    public function array(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Id',
            'Nomor Kartu Keluarga',
            'Alamat',
            'RT (Rukun Tetangga)',
            'RW (Rukun Warga)',
            'Desa / Kecamatan'
        ];
    }
}
