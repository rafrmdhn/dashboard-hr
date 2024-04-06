<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Staff;
use App\Models\Agency;
use App\Models\Intern;
use App\Models\Talent;
use Illuminate\Http\Request;

class BulkActionController extends Controller
{
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $model = $request->model;
        try {
            switch ($model) {
                case 'talent':
                    Talent::destroy($ids);
                    break;
                case 'staff':
                    Staff::destroy($ids);
                    break;
                case 'intern':
                    Intern::destroy($ids);
                    break;
                case 'brand':
                    Brand::destroy($ids);
                    break;
                case 'agency':
                    Agency::destroy($ids);
                    break;
                default:
                    break;
            }
            return response()->json(['success' => "Data Deleted successfully.", 'ids' => $request['ids'], 'model' => $request['model']]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
