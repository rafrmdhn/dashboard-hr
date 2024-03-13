<?php

namespace App\Imports;

use App\Models\Intern;
use Maatwebsite\Excel\Concerns\ToModel;

class InternImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Intern([
            'position_id' => $row[1],
            'email' => $row[2],
            'name' => $row[3],
            'photo'=>$row[4],
            'biography'=>$row[5],
            'university'=>$row[6],
            'instagram'=>$row[7],
            'linkedin'=>$row[8]
        ]);
    }
}
