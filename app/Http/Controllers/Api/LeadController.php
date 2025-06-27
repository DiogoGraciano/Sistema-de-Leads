<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Lead::with('hotel');
        $this->applyFilters($query, $request);
        
        $perPage = $request->get('per_page', 15);
        $leads = $query->orderBy('created_at', 'desc')->paginate($perPage);

        return response()->json([
            'message' => 'Leads recuperados com sucesso',
            'data' => $leads
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'hotel_id' => 'required|exists:hotels,id',
            'date' => 'nullable|date',
            'nr_room' => 'nullable|string|max:50',
            'question' => 'nullable|string',
        ]);

        $lead = Lead::create($request->all());
        $lead->load('hotel');

        return response()->json([
            'message' => 'Lead criado com sucesso',
            'data' => $lead
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead): JsonResponse
    {
        $lead->load('hotel');
        
        return response()->json([
            'message' => 'Lead recuperado com sucesso',
            'data' => $lead
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lead $lead): JsonResponse
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'hotel_id' => 'sometimes|required|exists:hotels,id',
            'date' => 'nullable|date',
            'nr_room' => 'nullable|string|max:50',
            'question' => 'nullable|string',
        ]);

        $lead->update($request->all());
        $lead->load('hotel');

        return response()->json([
            'message' => 'Lead atualizado com sucesso',
            'data' => $lead
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead): JsonResponse
    {
        $lead->delete();

        return response()->json([
            'message' => 'Lead excluído com sucesso'
        ]);
    }

    /**
     * Export leads to array format.
     */
    public function export(Request $request): JsonResponse
    {
        $query = Lead::with('hotel');
        $this->applyFilters($query, $request);
        
        $leads = $query->orderBy('created_at', 'desc')->get();

        $exportData = $leads->map(function ($lead) {
            return [
                'id' => $lead->id,
                'name' => $lead->name,
                'email' => $lead->email,
                'phone' => $lead->phone,
                'hotel' => $lead->hotel ? $lead->hotel->name : 'N/A',
                'date' => $lead->date ? \Carbon\Carbon::parse($lead->date)->format('d/m/Y H:i') : 'N/A',
                'nr_room' => $lead->nr_room,
                'question' => $lead->question ?? 'N/A',
                'created_at' => $lead->created_at->format('d/m/Y H:i:s')
            ];
        });

        return response()->json([
            'message' => 'Dados exportados com sucesso',
            'data' => $exportData,
            'total' => $exportData->count()
        ]);
    }

    /**
     * Get summary statistics.
     */
    public function summary(): JsonResponse
    {
        $totalLeads = Lead::count();
        $totalHotels = Hotel::count();
        $leadsThisMonth = Lead::whereMonth('created_at', now()->month)
                              ->whereYear('created_at', now()->year)
                              ->count();
        $leadsToday = Lead::whereDate('created_at', today())->count();

        return response()->json([
            'message' => 'Resumo recuperado com sucesso',
            'data' => [
                'total_leads' => $totalLeads,
                'total_hotels' => $totalHotels,
                'leads_this_month' => $leadsThisMonth,
                'leads_today' => $leadsToday
            ]
        ]);
    }

    /**
     * Get report by hotel.
     */
    public function reportByHotel(): JsonResponse
    {
        $reportData = Hotel::withCount('leads')
            ->orderBy('leads_count', 'desc')
            ->get()
            ->map(function ($hotel) {
                return [
                    'hotel_id' => $hotel->id,
                    'hotel_name' => $hotel->name,
                    'total_leads' => $hotel->leads_count
                ];
            });

        return response()->json([
            'message' => 'Relatório por hotel recuperado com sucesso',
            'data' => $reportData
        ]);
    }

    /**
     * Apply filters to the Lead query.
     */
    private function applyFilters($query, Request $request)
    {
        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        if ($request->filled('hotel_id')) {
            $query->where('hotel_id', $request->hotel_id);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }

        if ($request->filled('nr_room')) {
            $query->where('nr_room', 'like', '%' . $request->nr_room . '%');
        }

        if ($request->filled('question')) {
            $query->where('question', 'like', '%' . $request->question . '%');
        }
    }
} 