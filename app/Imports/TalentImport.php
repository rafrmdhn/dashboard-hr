<?php

namespace App\Imports;

use App\Models\Talent;
use Maatwebsite\Excel\Concerns\ToModel;

class TalentImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Talent([
            //
        ]);
    }
}
