<?php

namespace App\Imports;

use App\Models\Agency;
use Maatwebsite\Excel\Concerns\ToModel;

class AgencyImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Agency([
            'name' => $row[1],
            
        ]);
    }
}
