<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Intern;
use App\Models\Talent;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $positionData = Position::select('positions.name AS name', 
                        DB::raw('COUNT(DISTINCT interns.id) AS intern_count'),
                        DB::raw('COUNT(DISTINCT staff.id) AS staff_count'),
                        DB::raw('COUNT(DISTINCT interns.id) + COUNT(DISTINCT staff.id) AS total_count'))
                            ->leftJoin('interns', 'interns.position_id', '=', 'positions.id')
                            ->leftJoin('staff', 'staff.position_id', '=', 'positions.id')
                            ->groupBy('name')
                            ->get();

        // Prepare labels and data arrays (optional)
        $labels = [];
        $data = [];
        foreach ($positionData as $position) {
            $labels[] = $position->name; // Assuming position has a name attribute
            $data[] = $position->total_count;
        }

        // 4. Get additional counts for view (optional)
        $staffCount = Staff::count();
        $talentCount = Talent::count(); // Modify model name as needed
        $internCount = Intern::count();

        return view('dashboard', [
            'title' => 'Dashboard',
            'positions' => Position::count(), // Total positions (consider using cached value for efficiency)
            'staffs' => $staffCount,
            'talents' => $talentCount,
            'interns' => $internCount,
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}
