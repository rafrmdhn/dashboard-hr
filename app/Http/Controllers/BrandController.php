<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Staff;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('brand.main', [
            'title' => 'Brand',
            'search' => 'brand',
            'tables' => Brand::latest()->filter(request(['search', 'name']))->paginate(6)->withQueryString(),
            'categories' => Category::all(),
            'staffs' => Staff::all(),
            'export' => 'exportBrand'
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
            'category_id' => 'required',
            'photo' => 'image|file|max:1024'
        ]);

        $categories = $validatedData['category_id'];

        unset($validatedData['category_id']);
        
        if($request->file('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('images/brands');
        }

        $brand = Brand::create($validatedData);

        foreach ($categories as $category)
        {
            $brand->category()->attach($category);
        }

        return redirect('/brand')->with('success', 'Data has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255'           
        ]);

        Brand::where('id', $brand->id)
                ->update($validatedData);

        return redirect('/brand')->with('success', 'Data has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
