<?php

namespace App\Exports;

use App\Models\Earning;
use Maatwebsite\Excel\Concerns\FromCollection;

class EarningExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Earning::all();
    }
}
