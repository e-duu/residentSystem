<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResidentsTemplateExport implements FromArray, WithHeadings
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
            'Nama',
            'NIK',
            'Email',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Agama',
            'Pendidikan Terakhir',
            'Pekerjaan',
            'Status Pernikahan',
            'Alamat',
            'RT (Rukun Tetangga)',
            'RW (Rukun Warga)',
            'Desa / Kecamatan',
            'Kontak',
        ];
    }
}
