@extends('adminlte::page')

@section('title', "Detalhe {$detail->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li>
            <a class="breadcrumb-item" href="{{ route('admin.index') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('plans.index') }}">Planos</a>
            <a class="breadcrumb-item" href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a>
            <a class="breadcrumb-item" href="{{ route('details.plan.index', $plan->url) }}">Detalhe</a>
            <a class="breadcrumb-item active" href="{{ route('details.plan.edit', [$plan->url, $detail->id]) }}">Editar</a>
        </li>
    </ol>

    <h1>Detalhe {{$detail->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome:</strong> {{ $detail->name }}
                </li>
            </ul>
        </div>

        <div class="card-footer">
            <form action="{{ route('details.plan.destroy', [$plan->url, $detail->id]) }}" method="POST">
            @csrf
            @method("DELETE")
            <button type="submit" class="btn btn-danger">Deletar o detalhe {{ $detail->nome }}</button>
            </form>
        </div>
    </div>
@stop
