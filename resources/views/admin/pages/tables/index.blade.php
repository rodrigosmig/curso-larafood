@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <ol class="breadcrumb">
        <li>
            <a class="breadcrumb-item" href="{{ route('admin.index') }}">Dashboard</a>
            <a class="breadcrumb-item active" href="{{ route('tables.index') }}">Mesas</a>
        </li>
    </ol>

    <h1>Mesas <a href="{{ route('tables.create') }}" class="btn btn-dark">ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('tables.search') }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" id="" placeholder="Nome" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark form-control">Filtrar</button>
            </form>
        </div>

        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <th>Identify</th>
                    <th>Descrição</th>
                    <th width="150">Ações</th>
                </thead>

                <tbody>
                    @foreach ($tables as $table)
                        <tr>
                            <td>
                                {{ $table->identify }}
                            </td>
                            <td>
                                {{ $table->description }}
                            </td>
                            <td>
                                <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('tables.show', $table->id) }}" class="btn btn-warning">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $tables->appends($filters)->links() !!}
            @else
                {!! $tables->links() !!}
                
            @endif
        </div>
    </div>
@stop
