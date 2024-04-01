<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use App\Models\Staff;
use Illuminate\Http\Request;

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
            'export' => 'exportKinerja'
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
}
