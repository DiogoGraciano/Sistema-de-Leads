@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-neutral-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                        <p class="mt-1 text-sm text-gray-500">
                            Bem-vindo(a), {{ Auth::user()->name ?? Auth::user()->email }}!
                        </p>
                    </div>
                    <div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Sair
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Navegação Rápida -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Navegação Rápida</h3>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        <a href="{{ route('hotels.index') }}" class="bg-aviva-blue-50 hover:bg-aviva-blue-100 border border-aviva-blue-200 rounded-lg p-4 transition-colors duration-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-blue-900">Gerenciar Hotéis</h4>
                                    <p class="text-sm text-blue-700">Cadastrar e gerenciar hotéis</p>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('leads.index') }}" class="bg-aviva-green-50 hover:bg-aviva-green-100 border border-aviva-green-200 rounded-lg p-4 transition-colors duration-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-green-900">Gerenciar Leads</h4>
                                    <p class="text-sm text-green-700">Visualizar e gerenciar leads</p>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('reports.index') }}" class="bg-aviva-orange-50 hover:bg-aviva-orange-100 border border-aviva-orange-200 rounded-lg p-4 transition-colors duration-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-900">Estatísticas</h4>
                                    <p class="text-sm text-gray-700">Visualizar estatísticas</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="mt-8">
                    <div class="bg-neutral-50 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informações da Conta</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nome</label>
                                <p class="mt-1 text-sm text-gray-900">{{ Auth::user()->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <p class="mt-1 text-sm text-gray-900">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 