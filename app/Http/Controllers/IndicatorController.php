<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Indicator;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IndicatorStaffExport;

class IndicatorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $indicators = Indicator::query()
        ->when($search, function ($query, $search) {
            $query->whereHas('staff', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        })
        ->latest()
        ->paginate(6);

        return view('sperform.main', [
            'title' => 'Staff',
            'search' => 'kinerja-staff',
            'tables' => $indicators,
            'staffs' => Staff::all(),
            'export' => 'exportKinerjaStaff'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'staff_id' => 'required',
            'target' => 'required',
            'result' => 'required',
        ]);

        Indicator::create($validatedData);

        return redirect('/kinerja-staff')->with('success', 'Data has been added!');
    }

    public function update(Request $request, Indicator $indicator)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'staff_id' => 'required',
            'target' => 'required',
            'result' => 'required',
        ]);
    
        Indicator::where($indicator->id)->update($validatedData);
    
        return redirect('/kinerja-staff')->with('success', 'Data has been updated!');
    }

    public function destroy(Indicator $indicator)
    {
        try {
            Indicator::destroy($indicator->id);

            return redirect('/kinerja-staff')->with('success', 'Data has been deleted!');
        } catch (\Throwable $th) {
            return redirect('/kinerja-staff')->with('error', 'Data cannot Delete');
        }
    }

    public function export()
    {
        return Excel::download(new IndicatorStaffExport, 'kpi_staff.xlsx');
    }
}
