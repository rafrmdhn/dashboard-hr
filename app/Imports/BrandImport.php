<?php

namespace App\Imports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\ToModel;

class BrandImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Brand([
            'staff_id' => $row[1],
            'name' => $row[2],
            'email' => $row[3],
            'phone' => $row[4],
            'address' => $row[5],
        ]);
    }
}
