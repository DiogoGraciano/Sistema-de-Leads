<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $hotels = Hotel::withCount('leads')->orderBy('name')->get();
        
        return response()->json([
            'message' => 'Hotéis recuperados com sucesso',
            'data' => $hotels
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:hotels,name',
        ]);

        $hotel = Hotel::create($request->only('name'));

        return response()->json([
            'message' => 'Hotel criado com sucesso',
            'data' => $hotel
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel): JsonResponse
    {
        $hotel->loadCount('leads');
        
        return response()->json([
            'message' => 'Hotel recuperado com sucesso',
            'data' => $hotel
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hotel $hotel): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:hotels,name,' . $hotel->id,
        ]);

        $hotel->update($request->only('name'));

        return response()->json([
            'message' => 'Hotel atualizado com sucesso',
            'data' => $hotel
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel): JsonResponse
    {
        if ($hotel->leads()->count() > 0) {
            return response()->json([
                'message' => 'Não é possível excluir hotel com leads associados'
            ], 422);
        }

        $hotel->delete();

        return response()->json([
            'message' => 'Hotel excluído com sucesso'
        ]);
    }
} 