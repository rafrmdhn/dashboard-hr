<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Agency;
use Illuminate\Http\Request;

class DependantDropdownController extends Controller
{
    public function getAgencies(Request $request)
    {
        $agencies = Agency::select('id', 'name')->orderBy('name')->get();
        return response()->json($agencies);
    }

    public function getBrands()
    {
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        return response()->json($brands);
    }
}
