@extends('layouts.app')

@section('title', 'Visualizar Hotel - Ohnmacht')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Detalhes do Hotel</h1>
                        <p class="mt-1 text-sm text-gray-500">
                            Visualizar informações do hotel
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('hotels.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Voltar
                        </a>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">ID</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $hotel->id }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nome do Hotel</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $hotel->name }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Data de Criação</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $hotel->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Última Atualização</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $hotel->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 mt-6">
                    <a href="{{ route('hotels.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Voltar à Lista
                    </a>
                    <a href="{{ route('hotels.edit', $hotel) }}" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        Editar Hotel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 