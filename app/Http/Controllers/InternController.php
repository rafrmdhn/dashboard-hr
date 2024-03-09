<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\Position;
use Illuminate\Http\Request;

class InternController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request('name')){
            Intern::firstWhere('id', request(('name')));
        }

        return view('interns.main', [
            'title' => 'Intern',
            'search' => 'intern',
            'tables' => Intern::latest()->filter(request(['search', 'name']))->paginate(6)->withQueryString(),
            'positions' => Position::all(),
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
            'email' => 'required',
            'name' => 'required|max:255',
            'biography' => 'required|max:255',
            'position_id' => 'required|max:255',
            'university' => 'required|max:255',
            'photo' => 'image|file|max:1024', // 1MB Max
            'instagram' => 'required',
            'linkedin' => 'required'
        ]);

        if($request->file('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('images/interns');
        }

        Intern::create($validatedData);

        return redirect('/intern')->with('success', 'Data has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Intern $intern)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Intern $intern)
    {
        $validatedData = $request->validate([
            'email' => 'required',
            'name' => 'required|max:255',
            'biography' => 'required|max:255',
            'position_id' => 'required|max:255',
            'university' => 'required|max:255',
            'photo' => 'nullable|image|file|max:1024', // 1MB Max
            'instagram' => 'required',
            'linkedin' => 'required'
        ]);
        
        // Check if a new photo is uploaded
        if($request->file('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('images/interns');
        } 
        else {
            // No new photo uploaded, keep the existing one
            $validatedData['photo'] = $intern->photo;
        }

        Intern::where('id', $intern->id)
                ->update($validatedData);

        return redirect('/intern')->with('success', 'Data has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Intern $intern)
    {
        Intern::destroy($intern->id);

        return redirect('/intern')->with('success', 'Data has been deleted!');
    }
}
