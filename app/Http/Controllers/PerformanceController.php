<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\Performance;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IndicatorInternExport;

class PerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = request()->query('sort', 'id');
        $direction = request()->query('direction', 'asc');

        $tables = Performance::query()
            ->orderBy($sort, $direction)
            ->filter(request(['search']))
            ->paginate(10)
            ->withQueryString();

        return view('iperform.main', [
            'title' => 'Intern',
            'search' => 'kinerja-intern',
            'tables' => $tables,
            'interns' => Intern::all(),
            'export' => 'exportKinerjaIntern'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'intern_id' => 'required',
            'target' => 'required',
            'result' => 'required',
        ]);

        Performance::create($validatedData);

        return redirect('/kinerja-intern')->with('success', 'Data has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Performance $performance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Performance $performance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Performance $performance)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'intern_id' => 'required',
            'target' => 'required',
            'result' => 'required',
        ]);
    
        Performance::where($performance->id)->update($validatedData);
    
        return redirect('/kinerja-intern')->with('success', 'Data has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Performance $performance)
    {
        try {
            Performance::destroy($performance->id);

            return redirect('/kinerja-intern')->with('success', 'Data has been deleted!');
        } catch (\Throwable $th) {
            return redirect('/kinerja-intern')->with('error', 'Data cannot Delete');
        }
    }

    public function export()
    {
        return Excel::download(new IndicatorInternExport, 'kpi_intern.xlsx');
    }
}
