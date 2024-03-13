<?php

namespace App\Http\Controllers;

use App\Models\Talent;
use Illuminate\Http\Request;
use App\Exports\TalentExport;
use Maatwebsite\Excel\Facades\Excel;

class TalentController extends Controller
{
    public function index()
    {
        if(request('name')){
            Talent::firstWhere('id', request(('name')));
        }

        return view('talents.main', [
            'title' => 'Talent',
            'search' => 'talent',
            'tables' => Talent::latest()->filter(request(['search', 'name']))->paginate(6)->withQueryString(),
            'export' => 'exportTalent'
        ]);
    }

    public function store(Request  $request)
    {
        $validatedData = $request->validate([
            'email' => 'required',
            'name' => 'required|max:255',
            'biography' => 'required|max:255',
            'photo' => 'image|file|max:1024', // 1MB Max
            'instagram' => 'required',
            'linkedin' => 'required'
        ]);

        if($request->file('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('images/talents');
        }

        Talent::create($validatedData);

        return redirect('/talent')->with('success', 'Data has been added!');
    }

    public function update(Request $request, Talent $talent)
    {
        $validatedData = $request->validate([
            'email' => 'required',
            'name' => 'required|max:255',
            'biography' => 'required|max:255',
            'photo' => 'image|file|max:1024', // 1MB Max
            'instagram' => 'required',
            'linkedin' => 'required'
        ]);

        // Check if a new photo is uploaded
        if($request->file('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('images/talents');
        } 
        else {
            // No new photo uploaded, keep the existing one
            $validatedData['photo'] = $talent->photo;
        }

        Talent::where('id', $talent->id)
                ->update($validatedData);

        return redirect('/talent')->with('success', 'Data has been updated!');
    }

    public function destroy(Talent $talent)
    {
        Talent::destroy($talent->id);

        return redirect('/talent')->with('success', 'Data has been deleted!');
    }

    public function export()
    {
        return Excel::download(new TalentExport, 'talent.xlsx');
    }
}
