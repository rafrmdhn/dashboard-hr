<?php

namespace App\Exports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BrandExport implements FromQuery, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Brand::query();
    }

    public function map($brand): array
    {
        return [
            $brand->id,
            $brand->name,
            $brand->email,
            $brand->address,
            $brand->phone,
            $brand->categories->implode('name', ', '),
            $brand->staff->name
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Brand',
            'Email',
            'Alamat',
            'Nomor HP',
            'Kategori',
            'PIC'
        ];
    }
}
