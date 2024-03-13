<?php

namespace App\Imports;

use App\Models\Staff;
use Maatwebsite\Excel\Concerns\ToModel;

class StaffImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Staff([
            'position_id' => $row[1],
            'name' => $row[2],
            'email' => $row[3],            
            'biography'=>$row[4],
            'instagram'=>$row[5],
            'linkedin'=>$row[6],
            'photo'=>$row[7],
        ]);
    }
}
