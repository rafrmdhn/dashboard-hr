<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::orderBy('created_at', 'asc')->get();
        return view('position.main', [
            'title' => 'Posisi',
            'search' => '',
            'tables' => '',
            'export' => '',
            'positions' => $positions
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
    public function store(StorePositionRequest $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        // NAMA TIDAK BOLEH SAMA
        if (Position::where('name', $validatedData['name'])->exists()) {
            return redirect('/position')->with('error', 'Posisi sudah ada');
        }
        Position::create($validatedData);

        return redirect('/position')->with('success', 'Data has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePositionRequest $request, Position $position)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        // NAMA TIDAK BOLEH SAMA
        if (Position::where('name', $validatedData['name'])->exists()) {
            return redirect('/position')->with('error', 'Posisi sudah ada');
        }
        Position::where('id', $position->id)
                ->update($validatedData);
        
        return redirect('/position')->with('success', 'Data has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        Position::destroy($position->id);
        return redirect('/position')->with('success', 'Data has been deleted!');
    }
}
