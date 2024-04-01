<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Staff;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('agency.main', [
            'title' => 'Agency',
            'search' => 'agency',
            'tables' => Agency::latest()->filter(request(['search', 'name']))->paginate(6)->withQueryString(),
            'staffs' => Staff::all(),
            'export' => 'exportAgency'
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
            'name' => 'required|max:255',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'staff_id' => 'required',
            'photo' => 'image|file|max:1024'
        ]);

        if($request->file('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('images/agencies');
        }

        Agency::create($validatedData);

        return redirect('/agency')->with('success', 'Data has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agency $agency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agency $agency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agency $agency)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'staff_id' => 'required',
            'photo' => 'image|file|max:1024'
        ]);

        if($request->file('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('images/agencies');
        }

        Agency::where('id', $agency->id)
                ->update($validatedData);

        return redirect('/agency')->with('success', 'Data has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agency $agency)
    {
        //
    }
}
