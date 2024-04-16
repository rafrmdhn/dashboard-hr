<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Talent;
use App\Models\Category;
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
            'tables' => Talent::latest()->filter(request(['search', 'name', 'category']))->paginate(10)->withQueryString(),
            'categories' => Category::all(),
            'export' => 'exportTalent'
        ]);
    }

    public function store(Request  $request)
    {
        //
    }

    public function update(Request $request, Talent $talent)
    {
        $validatedData = $request->validate([
            'status' => 'required'
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
        try {
            Talent::destroy($talent->id);

            return redirect('/talent')->with('success', 'Data has been deleted!');
        } catch (\Throwable $th) {
            return redirect('/talent')->with('error', 'Data cannot Delete');
        }
    }

    public function export()
    {
        return Excel::download(new TalentExport, 'talent.xlsx');
    }

    public function registrasi()
    {
        return view('forms.form', [
            'title' => "FYP Media",
            'categories' => Category::all(),
            'staffs' => Staff::all(),
        ]);
    }

    public function form(Request $request)
    {   
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'phone' => 'required|max:12',
            'ttl' => 'required',
            'domicile' => 'required',
            'engagement' => 'required',
            'category_id' => 'required',
            'instagram' => 'required',
            'finstagram' => 'required',
            'rate_igs' => 'required',
            'rate_igf' => 'required',
            'rate_igr' => 'required',
            'rate_igl' => 'required',
            'tiktok' => 'required',
            'ftiktok' => 'required',
            'rate_ttf' => 'required',
            'rate_ttl' => 'required',
            'youtube' => 'required',
            'syoutube' => 'required',
            'rate_yt' => 'required',
            'rate_event' => 'required',
            'talent_exclusive' => 'required',
            'staff_id' => 'required',
            'shopee_affiliate' => 'required',
            'tiktok_affiliate' => 'required',
            'mcn_tiktok' => 'required',
            'photo' => 'image|file|max:1024',   
        ]);

        $categories = $validatedData['category_id'];

        unset($validatedData['category_id']);

        if($request->file('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('images/talents');
        }

        $talent = Talent::create($validatedData);

        foreach ($categories as $category)
        {
            $talent->category()->attach($category);
        }

        return redirect('/registrasi-talent')->with('success', 'Berhasil Mendaftar!');
    }

    public function page()
    {
        return view('forms.main', [
            'title' => 'Registrasi',
            'search' => 'fregsitrasi',
            'tables' => Talent::latest()->filter(request(['search', 'name']))->paginate(6)->withQueryString(),
            'export' => 'exportRegis'
        ]);
    }

    public function updateForm(Request $request, Talent $talent)
    {
        $validatedData = $request->validate([
            'status' => 'required'
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

        return redirect('/fregistrasi')->with('success', 'Data has been updated!');
    }
}
