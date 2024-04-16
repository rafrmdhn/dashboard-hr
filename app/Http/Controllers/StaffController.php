<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Position;
use App\Exports\StaffExport;
use App\Imports\StaffImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request('name')){
            Staff::firstWhere('id', request(('name')));
        }

        return view('staff.main', [
            'title' => 'Staff',
            'search' => 'staff',
            'tables' => Staff::latest()->filter(request(['search', 'name', 'position']))->paginate(10)->withQueryString(),
            'positions' => Position::all(),
            'export' => 'exportStaff'
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
            'phone' => 'required|max:12',
            'place' => 'required',
            'birth' => 'required',
            'domicile' => 'required',
            'address' => 'required|max:255',
            'position_id' => 'required|max:255',
            'photo' => 'image|file|max:1024', // 1MB Max
            'instagram' => 'required',
            'linkedin' => 'required'
        ]);

        if($request->file('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('images/staffs');
        }

        Staff::create($validatedData);

        return redirect('/staff')->with('success', 'Data has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        $validatedData = $request->validate([
            'email' => 'required',
            'name' => 'required|max:255',
            'phone' => 'required|max:12',
            'place' => 'required',
            'birth' => 'required',
            'domicile' => 'required',
            'address' => 'required|max:255',
            'position_id' => 'required|max:255',
            'photo' => 'image|file|max:1024', // 1MB Max
            'instagram' => 'required',
            'linkedin' => 'required'
        ]);

        // Check if a new photo is uploaded
        if($request->file('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('images/staffs');
        } 
        else {
            // No new photo uploaded, keep the existing one
            $validatedData['photo'] = $staff->photo;
        }

        Staff::where('id', $staff->id)
                ->update($validatedData);

        return redirect('/staff')->with('success', 'Data has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        Staff::destroy($staff->id);

        return redirect('/staff')->with('success', 'Data has been deleted!');
    }

    public function export()
    {
        return Excel::download(new StaffExport, 'staff.xlsx');
    }

    public function import(Request $request)
    {
        $validatedData = $request->file('file');

        $fileName = $validatedData->getClientOriginalName();
        $validatedData->move('StaffData', $fileName);

        Excel::import(new StaffImport, public_path('/StaffData/'.$fileName)); 
        
        return redirect('/staff')->with('success', 'Data has been added!');
    }
}
