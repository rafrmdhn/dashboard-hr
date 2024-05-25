<?php

namespace App\Http\Controllers;

use App\Exports\BrandExport;
use App\Imports\BrandImport;
use App\Models\Brand;
use App\Models\Staff;
use App\Models\Category;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request('name')){
            Brand::firstWhere('id', request(('name')));
        }

        $sort = request()->query('sort', 'id');
        $direction = request()->query('direction', 'asc');

        $tables = Brand::query()
            ->with('categories')
            ->when($sort === 'category', function($query) use ($direction) {
                $query->leftJoin('brand_category', 'brands.id', '=', 'brand_category.brand_id')
                    ->orderBy('brand_category.category_id', $direction);
            }, function($query) use ($sort, $direction) {
                $query->orderBy($sort, $direction);
            })
            ->filter(request(['search', 'name', 'category']))
            ->paginate(10)
            ->withQueryString();

        return view('brand.main', [
            'title' => 'Brand',
            'search' => 'brand',
            'tables' => $tables,
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
            $brand->categories()->attach($category);
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
        
        if ($request->file('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('images/brands');
        } else {
            $validatedData['photo'] = $brand->photo;
        }

        // Update the brand without reassigning it
        Brand::where('id', $brand->id)->update($validatedData);
                    
        // Now use the existing model instance to manage the relationship
        $brand->categories()->sync($categories);

        return redirect('/brand')->with('success', 'Data has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        try {
            Brand::destroy($brand->id);

            return redirect('/brand')->with('success', 'Data has been deleted!');
        } catch (\Throwable $th) {
            return redirect('/brand')->with('error', 'Data cannot Delete');
        }
    }

    public function export() 
    {
        return Excel::download(new BrandExport, 'brand.xlsx');
    }

    public function import(Request $request)
    {
        $validatedData = $request->file('file');

        $fileName = $validatedData->getClientOriginalName();
        $validatedData->move('BrandData', $fileName);

        Excel::import(new BrandImport, public_path('/BrandData/'.$fileName)); 
        
        return redirect('/brand')->with('success', 'Data has been added!');
    }
}
