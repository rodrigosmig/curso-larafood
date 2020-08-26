@extends('adminlte::page')

@section('title', "Detalhes do Plano: {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li>
            <a class="breadcrumb-item" href="{{ route('admin.index') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('plans.index') }}">Planos</a>
            <a class="breadcrumb-item" href="{{ route('plans.show', $plan->url) }}">{{ $plan->name }}</a>
            <a class="breadcrumb-item active" href="{{ route('details.plan.index', $plan->url) }}">Detalhes</a>
        </li>
    </ol>

    <h1>Detalhes do Plano: {{$plan->name }} <a href="{{ route('details.plan.create', $plan->url) }}" class="btn btn-dark">ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('plans.search') }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" id="" placeholder="Nome" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark form-control">Filtrar</button>
            </form>
        </div>

        <div class="card-body">
            @include('admin.includes.alerts')
            <table class="table table-condensed">
                <thead>
                    <th>Nome</th>
                    <th width="150">Ações</th>
                </thead>

                <tbody>
                    @foreach ($details as $detail)
                        <tr>
                            <td>
                                {{ $detail->name }}
                            </td>                            
                            <td>
                                <a href="{{ route('details.plan.edit', [$plan->url, $detail->id]) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('details.plan.show', [$plan->url, $detail->id]) }}" class="btn btn-warning">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $details->appends($filters)->links() !!}
            @else
                {!! $details->links() !!}
                
            @endif
        </div>
    </div>
@stop
