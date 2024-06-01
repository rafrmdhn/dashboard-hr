<?php

namespace App\Http\Controllers;

use App\Models\Earning;
use App\Models\Staff;
use App\Models\Intern;
use App\Models\Talent;
use App\Models\Position;
use App\Models\Indicator;
use App\Models\Performance;
use App\Models\Spending;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $internData = Performance::selectRaw('MONTH(created_at) as month, SUM(result) as result')
                        ->whereBetween('created_at', ['2024-02-01', '2024-06-30'])
                        ->groupByRaw('MONTH(created_at)')
                        ->get()
                        ->map(function ($item) {
                            $item->month_name = Carbon::createFromDate(null, $item->month)->monthName;
                            return $item;
                        });

        $staffData  = Indicator::selectRaw('MONTH(created_at) as month, SUM(result) as result')
                        ->whereBetween('created_at', ['2024-02-01', '2024-06-30'])
                        ->groupByRaw('MONTH(created_at)')
                        ->get()
                        ->map(function ($item) {
                            $item->month_name = Carbon::createFromDate(null, $item->month)->monthName;
                            return $item;
                        });

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
        $talentCount = Talent::where('status', 1)->count();
        $internCount = Intern::count();

        return view('dashboard', [
            'title' => 'Dashboard',
            'positions' => Position::count(), // Total positions (consider using cached value for efficiency)
            'staffs' => $staffCount,
            'talents' => $talentCount,
            'interns' => $internCount,
            'labels' => $labels,
            'pie' => $data,
            'internData' => $internData,
            'staffData' => $staffData,
            'earnings' => Earning::where('status', 'selesai')->latest()->paginate(5),
            // 'spendings' => Spending::latest()->paginate(5)
            'spendings' => Spending::where('status', 'selesai')->latest()->paginate(5),
        ]);
    }
}
