@extends('adminlte::page')

@section('title', "Detalhes do Plano {$tenant->name}")

@section('content_header')
    <h1>Detalhes da Empresa <b>{{ $tenant->name }}</b></h1> 
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <img src="{{ url("storage/{$tenant->logo}") }}" alt="{{ $tenant->name }}" style="max-width: 90px">
            <ul>
                <li>
                    <strong>Plano:</strong> {{ $tenant->plan->name }}
                </li>
                <li>
                    <strong>Nome:</strong> {{ $tenant->name }}
                </li>
                <li>
                    <strong>URL:</strong> {{ $tenant->url }}
                </li>
                <li>
                    <strong>E-mail:</strong> {{ $tenant->email }}
                </li>
                <li>
                    <strong>CNPJ:</strong> {{ $tenant->cnpj }}
                </li>
                <li>
                    <strong>Ativo:</strong> {{ $tenant->active =='Y' ? 'Sim' : 'Não' }}
                </li>
            </ul>

            <hr>

            <ul>
                <li>
                    <strong>Data Assinatura:</strong> {{ $tenant->subscription }}
                </li>
                <li>
                    <strong>Data Expira:</strong> {{ $tenant->expires_at }}
                </li>
                <li>
                    <strong>Identificador:</strong> {{ $tenant->subscription_id }}
                </li>
                <li>
                    <strong>E-mail:</strong> {{ $tenant->email }}
                </li>
                <li>
                    <strong>Ativo:</strong> {{ $tenant->subscription_active =='Y' ? 'Sim' : 'Não' }}
                </li>
                <li>
                    <strong>Cancelado:</strong> {{ $tenant->subscription_active =='Y' ? 'Sim' : 'Não' }}
                </li>
            </ul>


            @include('admin.includes.alerts')
        </div>
    </div>
@endsection
