<?php

namespace App\Exports;

use App\Models\Agency;
use Maatwebsite\Excel\Concerns\FromCollection;

class AgencyExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Agency::all();
    }
}
