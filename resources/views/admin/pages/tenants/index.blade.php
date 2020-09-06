@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <ol class="breadcrumb">
        <li>
            <a class="breadcrumb-item" href="{{ route('admin.index') }}">Dashboard</a>
            <a class="breadcrumb-item active" href="{{ route('tenants.index') }}">Empresas</a>
        </li>
    </ol>

    <h1>Empresas <a href="{{ route('tenants.create') }}" class="btn btn-dark">ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('tenants.search') }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" id="" placeholder="Nome" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark form-control">Filtrar</button>
            </form>
        </div>

        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <th width="90">Logo</th>
                    <th>Nome</th>
                    <th width="150">Ações</th>
                </thead>

                <tbody>
                    @foreach ($tenants as $tenant)
                        <tr>
                            <td>
                                <img src="{{ url("storage/{$tenant->logo}") }}" alt="{{ $tenant->title }}" style="max-width: 90px">
                            </td>
                            <td>
                                {{ $tenant->name }}
                            </td>
                            <td>
                                <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('tenants.show', $tenant->id) }}" class="btn btn-warning">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $tenants->appends($filters)->links() !!}
            @else
                {!! $tenants->links() !!}
                
            @endif
        </div>
    </div>
@stop
