@extends('adminlte::page')

@section('title', "Permissões do Perfil {$product->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li>
            <a class="breadcrumb-item" href="{{ route('admin.index') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('products.index') }}">Planos</a>
            <a class="breadcrumb-item" href="{{ route('products.categories', $product->id) }}">Categorias</a>
            <a class="breadcrumb-item active" href="{{ route('products.categories.available', $product->id) }}">Disponíveis</a>
        </li>
    </ol>

    <h1>Categorias disponíveis do produto <strong>{{ $product->title }}</strong>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('products.categories.available', $product->id) }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Filtro" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark form-control">Filtrar</button>
            </form>
        </div>

        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <th width="50px">#</th>
                    <th>Nome</th>
                </thead>

                <tbody>
                    <form action="{{ route('products.categories.attach', $product->id) }}" method="POST">
                        @csrf
                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                                </td>
                                <td>
                                    {{ $category->name }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="500">
                                @include('admin.includes.alerts')
                                <button class="btn btn-success" type="submit">Vincular</button>
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $categories->appends($filters)->links() !!}
            @else
                {!! $categories->links() !!}
                
            @endif
        </div>
    </div>
@stop
