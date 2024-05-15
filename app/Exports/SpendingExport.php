<?php

namespace App\Exports;

use App\Models\Spending;
use Maatwebsite\Excel\Concerns\FromCollection;

class SpendingExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Spending::all();
    }
}
