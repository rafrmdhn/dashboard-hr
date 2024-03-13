<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use Illuminate\Http\Request;

class CustomInternController extends Controller
{
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        dd($ids);
        Intern::whereIn('id', $ids)->delete();

        return redirect('/intern')->with('success', 'Data has been deleted!');
    }
}
