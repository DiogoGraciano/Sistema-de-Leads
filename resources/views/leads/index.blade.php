@extends('layouts.app')

@section('title', 'Leads - Ohnmacht')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Leads</h1>
                        <p class="mt-1 text-sm text-gray-500">
                            Gerencie os leads do sistema
                        </p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Dashboard
                        </a>
                    </div>
                </div>

                @if (session('success'))
                    <div class="bg-green-50 border border-green-200 rounded-md p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
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
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Filtros</h3>
                        <button type="button" id="toggleFilters" class="text-sm text-blue-600 hover:text-blue-800">
                            <span id="filterToggleText">Mostrar filtros</span>
                        </button>
                    </div>
                    
                    <form method="GET" action="{{ route('leads.index') }}" id="filterForm" class="hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                            <!-- Filtro por ID -->
                            <div>
                                <label for="id" class="block text-sm font-medium text-gray-700 mb-1">ID</label>
                                <input type="number" name="id" id="id" value="{{ request('id') }}"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            </div>

                            <!-- Filtro por Nome -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                                <input type="text" name="name" id="name" value="{{ request('name') }}"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                       placeholder="Digite o nome...">
                            </div>

                            <!-- Filtro por Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" id="email" value="{{ request('email') }}"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                       placeholder="Digite o email...">
                            </div>

                            <!-- Filtro por Telefone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                                <input type="text" name="phone" id="phone" value="{{ request('phone') }}"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                       placeholder="Digite o telefone...">
                            </div>

                            <!-- Filtro por Hotel -->
                            <div>
                                <label for="hotel_id" class="block text-sm font-medium text-gray-700 mb-1">Hotel</label>
                                <select name="hotel_id" id="hotel_id"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                    <option value="">Todos os hotéis</option>
                                    @foreach($hotels as $hotel)
                                        <option value="{{ $hotel->id }}" {{ request('hotel_id') == $hotel->id ? 'selected' : '' }}>
                                            {{ $hotel->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Filtro por Data (De) -->
                            <div>
                                <label for="date_from" class="block text-sm font-medium text-gray-700 mb-1">Data (De)</label>
                                <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            </div>

                            <!-- Filtro por Data (Até) -->
                            <div>
                                <label for="date_to" class="block text-sm font-medium text-gray-700 mb-1">Data (Até)</label>
                                <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            </div>

                            <!-- Filtro por Número do Quarto -->
                            <div>
                                <label for="nr_room" class="block text-sm font-medium text-gray-700 mb-1">Quarto</label>
                                <input type="text" name="nr_room" id="nr_room" value="{{ request('nr_room') }}"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                       placeholder="Digite o número...">
                            </div>

                            <!-- Filtro por Com que frequência você visita a gente? -->
                            <div>
                                <label for="question" class="block text-sm font-medium text-gray-700 mb-1">Com que frequência você visita a gente?</label>
                                <input type="text" name="question" id="question" value="{{ request('question') }}"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                                       placeholder="Digite a frequência...">
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-3 mt-6">
                            <a href="{{ route('leads.index') }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Limpar Filtros
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Aplicar Filtros
                            </button>
                        </div>
                    </form>
                </div>

                @if($leads->count() > 0)
                    <!-- Contador de resultados e botões de exportação -->
                    <div class="mb-4 flex items-center justify-between">
                        <p class="text-sm text-gray-700">
                            Mostrando <span class="font-medium">{{ $leads->count() }}</span> lead{{ $leads->count() != 1 ? 's' : '' }}
                            @if(request()->hasAny(['id', 'name', 'email', 'phone', 'hotel_id', 'date_from', 'date_to', 'nr_room']))
                                <span class="text-blue-600">(filtrados)</span>
                            @endif
                        </p>
                        
                        <div class="flex space-x-2">
                            @if(request()->hasAny(['id', 'name', 'email', 'phone', 'hotel_id', 'date_from', 'date_to', 'nr_room']))
                                <!-- Exportar apenas filtrados -->
                                <a href="{{ route('leads.export.csv', request()->query()) }}" 
                                   class="inline-flex items-center px-3 py-2 border border-green-300 text-sm font-medium rounded-md text-green-700 bg-green-50 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Exportar Filtrados ({{ $leads->count() }})
                                </a>
                            @endif
                            
                            <!-- Exportar todos -->
                            <a href="{{ route('leads.export.csv') }}" 
                               class="inline-flex items-center px-3 py-2 border border-blue-300 text-sm font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                @if(request()->hasAny(['id', 'name', 'email', 'phone', 'hotel_id', 'date_from', 'date_to', 'nr_room']))
                                    Exportar Todos
                                @else
                                    Exportar CSV
                                @endif
                            </a>
                        </div>
                    </div>

                    <div class="overflow-x-auto shadow ring-1 ring-gray-300 ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nome
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Telefone
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Hotel
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Data
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Quarto
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Com que frequência você visita a gente?
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ações
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($leads as $lead)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $lead->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $lead->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $lead->email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $lead->phone }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $lead->hotel ? $lead->hotel->name : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $lead->date ? \Carbon\Carbon::parse($lead->date)->format('d/m/Y') : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $lead->nr_room }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $lead->question }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <a href="{{ route('leads.show', $lead) }}" class="text-blue-600 hover:text-blue-900">
                                                    Ver
                                                </a>
                                                <form method="POST" action="{{ route('leads.destroy', $lead) }}" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este lead?')">
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
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if(request()->hasAny(['id', 'name', 'email', 'phone', 'hotel_id', 'date_from', 'date_to', 'nr_room']))
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            @endif
                        </svg>
                        @if(request()->hasAny(['id', 'name', 'email', 'phone', 'hotel_id', 'date_from', 'date_to', 'nr_room']))
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhum lead encontrado</h3>
                            <p class="mt-1 text-sm text-gray-500">Não foram encontrados leads com os filtros aplicados.</p>
                            <div class="mt-4 flex space-x-3 justify-center">
                                <a href="{{ route('leads.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-blue-600 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Limpar filtros
                                </a>
                                <a href="{{ route('leads.export.csv') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-gray-600 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Exportar Todos
                                </a>
                            </div>
                        @else
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhum lead cadastrado</h3>
                            <p class="mt-1 text-sm text-gray-500">Não há leads no sistema ainda.</p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('toggleFilters');
    const filterForm = document.getElementById('filterForm');
    const toggleText = document.getElementById('filterToggleText');
    
    // Verificar se há filtros ativos
    const hasActiveFilters = {{ request()->hasAny(['id', 'name', 'email', 'phone', 'hotel_id', 'date_from', 'date_to', 'nr_room']) ? 'true' : 'false' }};
    
    // Mostrar filtros automaticamente se há filtros ativos
    if (hasActiveFilters) {
        filterForm.classList.remove('hidden');
        toggleText.textContent = 'Ocultar filtros';
    }
    
    // Toggle dos filtros
    toggleButton.addEventListener('click', function() {
        if (filterForm.classList.contains('hidden')) {
            filterForm.classList.remove('hidden');
            toggleText.textContent = 'Ocultar filtros';
        } else {
            filterForm.classList.add('hidden');
            toggleText.textContent = 'Mostrar filtros';
        }
    });
    
    // Adicionar indicador visual de filtros ativos
    if (hasActiveFilters) {
        const filtersTitle = document.querySelector('h3');
        if (filtersTitle) {
            const badge = document.createElement('span');
            badge.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 ml-2';
            badge.textContent = 'Filtros ativos';
            filtersTitle.appendChild(badge);
        }
    }
    
    // Adicionar feedback para exportação CSV
    const exportButtons = document.querySelectorAll('a[href*="export-csv"]');
    exportButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const originalText = this.innerHTML;
            this.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Exportando...';
            this.classList.add('pointer-events-none', 'opacity-75');
            
            // Restaurar o botão após 3 segundos
            setTimeout(() => {
                this.innerHTML = originalText;
                this.classList.remove('pointer-events-none', 'opacity-75');
            }, 3000);
        });
    });
});
</script>

@endsection 