<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ComersTemplateExport implements FromArray, WithHeadings
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
            'NIK',
            'Nama',
            'Jenis Kelamin',
            'Waktu Kedatangan',
            'Pelapor (Id Penduduk)'
        ];
    }
}
