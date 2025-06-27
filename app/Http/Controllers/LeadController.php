<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Hotel;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Lead::with('hotel');
        $this->applyFilters($query, $request);
        
        $leads = $query->orderBy('created_at', 'desc')->get();
        $hotels = Hotel::orderBy('name')->get();

        return view('leads.index', compact('leads', 'hotels'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        return view('leads.show', compact('lead'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead excluído com sucesso!');
    }

    /**
     * Export leads to CSV with applied filters.
     */
    public function exportCsv(Request $request)
    {
        $query = Lead::with('hotel');
        $this->applyFilters($query, $request);
        
        $leads = $query->orderBy('created_at', 'desc')->get();

        $filename = 'leads_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function() use ($leads) {
            $file = fopen('php://output', 'w');
            
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            fputcsv($file, [
                'ID',
                'Nome',
                'Email', 
                'Telefone',
                'Hotel',
                'Data',
                'Quarto',
                'Com que frequência você visita a gente?',
                'Data de Criação'
            ], ';');

            foreach ($leads as $lead) {
                fputcsv($file, [
                    $lead->id,
                    $lead->name,
                    $lead->email,
                    $lead->phone,
                    $lead->hotel ? $lead->hotel->name : 'N/A',
                    $lead->date ? \Carbon\Carbon::parse($lead->date)->format('d/m/Y H:i') : 'N/A',
                    $lead->nr_room,
                    $lead->question ?? 'N/A',
                    $lead->created_at->format('d/m/Y H:i:s')
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
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
