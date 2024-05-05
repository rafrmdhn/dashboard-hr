<?php

namespace App\Http\Controllers;

use App\Models\Sow;
use App\Models\Talent;
use App\Models\Earning;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFinanceRequest;
use App\Http\Requests\UpdateFinanceRequest;
use Illuminate\Support\Facades\DB;

class EarningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('earnings.main', [
            'title' => 'Pendapatan',
            'search' => 'earnings',
            'tables' => Earning::latest()->filter(request(['search', 'name', 'bulan', 'tahun', 'tipe', 'status']))->paginate(10)->withQueryString(),
            'export' => 'exportEarnings',
            'talents' => Talent::orderBy('name')->get(),
            'sows' => Sow::orderBy('id')->get(),
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
            'name' => 'required',
            'earnable_id' => 'required',
            'earnable_type' => 'required',
            'talent_id' => 'required',
            'date' => 'required',
            'sows' => 'required',
            'rate' => 'required|numeric',
            'link_project' => 'nullable|url',
        ]);

        // transaction
        try {
            DB::transaction(function () use ($validatedData) {
                $earning = Earning::create($validatedData);
    
                // Generate talent_rate and note for each sow
                $sowsIDs = $validatedData['sows'];
                
                // get all sows based on the IDs
                $sows = Sow::find($sowsIDs);

                // get talent based on the ID
                $talent = Talent::find($validatedData['talent_id']);

                foreach ($sows as $sow) {
                    $talent_rate = 0;
                    switch ($sow->name) {
                        case 'IG Feed':
                            $talent_rate = $talent->rate_igf;
                            break;
                        case 'IG Story':
                            $talent_rate = $talent->rate_igs;
                            break;
                        case 'IG Reels':
                            $talent_rate = $talent->rate_igr;
                            break;
                        case 'IG Live':
                            $talent_rate = $talent->rate_igl;
                            break;
                        case 'Tiktok':
                            $talent_rate = $talent->rate_ttf;
                            break;
                        case 'Tiktok Live':
                            $talent_rate = $talent->rate_ttl;
                            break;
                        case 'Youtube':
                            $talent_rate = $talent->rate_yt;
                            break;
                        case 'Attandance':
                            $talent_rate = $talent->rate_yt;
                            break;
                        default:
                            $talent_rate = 0;
                            break;
                    }

                    $earning->sows()->attach($sow, [
                        'talent_rate' => $talent_rate
                    ]);
                }
            });

            return redirect()->route('earnings.index')->with('success', 'Pendapatan berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('earnings.index')->with('error', 'Pendapatan gagal ditambahkan');
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(Earning $earning)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Earning $earning)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Earning $earning)
    {
        $validatedData = $request->validate([
            'status' => 'required',
            'link_project' => 'nullable|url',
        ]);

        Earning::where('id', $earning->id)
                ->update($validatedData);

        return redirect('/earnings')->with('success', 'Data has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Earning $earning)
    {
        try {
            Earning::destroy($earning->id);

            return redirect('/earnings')->with('success', 'Data has been deleted!');
        } catch (\Throwable $th) {
            return redirect('/earnings')->with('error', 'Data cannot Delete');
        }
    }
}
