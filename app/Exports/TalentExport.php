<?php

namespace App\Exports;

use App\Models\Talent;
use Maatwebsite\Excel\Concerns\FromCollection;

class TalentExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Talent::all();
    }
}
