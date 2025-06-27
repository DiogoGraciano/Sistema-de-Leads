<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $totalHotels = Hotel::count();
        $totalLeads = Lead::count();
        $totalUsers = User::count();
        
        $leadsByHotel = Hotel::withCount('leads')
            ->orderBy('leads_count', 'desc')
            ->get();
        
        $leadsByDay = Lead::select(
                DB::raw("DATE(created_at) as date"),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupByRaw('DATE(created_at)')
            ->orderBy('date', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'period' => Carbon::parse($item->date)->format('d/m/Y'),
                    'count' => $item->count,
                    'date' => $item->date
                ];
            });
        
        $recentLeads = Lead::with('hotel')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        $topHotels = Hotel::withCount('leads')
            ->orderBy('leads_count', 'desc')
            ->take(10)
            ->get()
            ->filter(function ($hotel) {
                return $hotel->leads_count > 0;
            })
            ->take(5);
        
        $last30DaysLeads = Lead::where('created_at', '>=', Carbon::now()->subDays(1))->count();
        $last30DaysHotels = Hotel::where('created_at', '>=', Carbon::now()->subDays(1))->count();
        
        return view('reports.index', compact(
            'totalHotels',
            'totalLeads', 
            'totalUsers',
            'leadsByHotel',
            'leadsByDay',
            'recentLeads',
            'topHotels',
            'last30DaysLeads',
            'last30DaysHotels'
        ));
    }
} 