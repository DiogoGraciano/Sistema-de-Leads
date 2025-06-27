@extends('layouts.app')

@section('title', 'Detalhes do Lead')

@section('content')
<div class="min-h-screen bg-neutral-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Detalhes do Lead</h1>
                        <p class="mt-1 text-sm text-gray-500">
                            Informações completas do lead #{{ $lead->id }}
                        </p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('leads.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            ← Voltar
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    <!-- Informações Pessoais -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informações Pessoais</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Nome</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $lead->name }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Email</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $lead->email }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Telefone</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $lead->phone }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Informações da Reserva -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informações da Reserva</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Hotel</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $lead->hotel ? $lead->hotel->name : 'N/A' }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Data da Reserva</label>
                                <p class="mt-1 text-sm text-gray-900">
                                    {{ $lead->date ? \Carbon\Carbon::parse($lead->date)->format('d/m/Y') : 'N/A' }}
                                </p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Número de Quartos</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $lead->nr_room }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Pergunta/Observações -->
                    @if($lead->question)
                    <div class="lg:col-span-2 bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Pergunta/Observações</h3>
                        <p class="text-sm text-gray-900">{{ $lead->question }}</p>
                    </div>
                    @endif

                    <!-- Informações do Sistema -->
                    <div class="lg:col-span-2 bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informações do Sistema</h3>
                        
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Data de Criação</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $lead->created_at->format('d/m/Y H:i:s') }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500">Última Atualização</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $lead->updated_at->format('d/m/Y H:i:s') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ações -->
                <div class="mt-8 flex justify-end space-x-3">
                    <form method="POST" action="{{ route('leads.destroy', $lead) }}" class="inline" onsubmit="return confirm('Tem certeza que deseja excluir este lead?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Excluir Lead
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 