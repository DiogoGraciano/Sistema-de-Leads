@extends('layouts.app')

@section('title', 'Hotéis - Ohnmacht')

@section('content')
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Hotéis</h1>
                            <p class="mt-1 text-sm text-gray-500">
                                Gerencie os hotéis do sistema
                            </p>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('dashboard') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Dashboard
                            </a>
                            <a href="{{ route('hotels.create') }}"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                + Novo Hotel
                            </a>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-50 border border-green-200 rounded-md p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">
                                        {{ session('success') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Filtros -->
                    <div class="bg-gray-50 px-4 py-5 sm:p-6 rounded-lg mb-6">
                        <form method="GET" action="{{ route('hotels.index') }}" class="space-y-4">
                            <div class="flex flex-wrap gap-4">
                                <!-- Filtro por nome -->
                                <div class="flex-1 min-w-64">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nome do
                                        Hotel</label>
                                    <input type="text" id="name" name="name" value="{{ request('name') }}"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                        placeholder="Digite o nome do hotel...">
                                </div>

                                <!-- Filtro por data (desde) -->
                                <div class="w-40">
                                    <label for="date_from" class="block text-sm font-medium text-gray-700">Data
                                        Desde</label>
                                    <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>

                                <!-- Filtro por data (até) -->
                                <div class="w-40">
                                    <label for="date_to" class="block text-sm font-medium text-gray-700">Data Até</label>
                                    <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                            </div>

                            <!-- Botões de ação -->
                            <div class="flex space-x-3">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Filtrar
                                </button>
                                <a href="{{ route('hotels.index') }}"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Limpar Filtros
                                </a>
                            </div>
                        </form>
                    </div>

                    @if ($hotels->count() > 0)
                        <!-- Informação sobre resultados -->
                        <div class="mb-4">
                            <p class="text-sm text-gray-500">
                                Mostrando {{ $hotels->count() }}
                                {{ $hotels->count() == 1 ? 'hotel encontrado' : 'hotéis encontrados' }}
                                @if (request()->hasAny(['name', 'date_from', 'date_to']))
                                    com os filtros aplicados
                                @endif
                            </p>
                        </div>

                        <div class="overflow-hidden shadow ring-1 ring-gray-300 ring-opacity-5 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nome
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Data de Criação
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Ações</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($hotels as $hotel)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $hotel->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $hotel->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $hotel->created_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-end space-x-2">
                                                    <a href="{{ route('hotels.show', $hotel) }}"
                                                        class="text-blue-600 hover:text-blue-900">
                                                        Ver
                                                    </a>
                                                    <a href="{{ route('hotels.edit', $hotel) }}"
                                                        class="text-yellow-600 hover:text-yellow-900">
                                                        Editar
                                                    </a>
                                                    <form method="POST" action="{{ route('hotels.destroy', $hotel) }}"
                                                        class="inline"
                                                        onsubmit="return confirm('Tem certeza que deseja excluir este hotel?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                                            Excluir
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhum hotel encontrado</h3>
                            @if (App\Models\Hotel::count() == 0)
                                <p class="mt-1 text-sm text-gray-500">Comece criando um novo hotel.</p>
                                <div class="mt-6">
                                    <a href="{{ route('hotels.create') }}"
                                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        + Cadastrar primeiro hotel
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
