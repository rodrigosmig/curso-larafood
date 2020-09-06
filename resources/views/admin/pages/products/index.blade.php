@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <ol class="breadcrumb">
        <li>
            <a class="breadcrumb-item" href="{{ route('admin.index') }}">Dashboard</a>
            <a class="breadcrumb-item active" href="{{ route('products.index') }}">Produtos</a>
        </li>
    </ol>

    <h1>Produtos <a href="{{ route('products.create') }}" class="btn btn-dark">ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('products.search') }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" id="" placeholder="Nome" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark form-control">Filtrar</button>
            </form>
        </div>

        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <th width="90">Imagem</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th width="190">Ações</th>
                </thead>

                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                <img src="{{ url("storage/{$product->image}") }}" alt="{{ $product->title }}" style="max-width: 90px">
                            </td>
                            <td>
                                {{ $product->title }}
                            </td>
                            <td>
                                {{ $product->description }}
                            </td>
                            <td>
                                <a href="{{ route('products.categories', $product->id) }}" class="btn btn-info" title="categorias"><i class="fas fa-layer-group"></i></a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-warning">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $products->appends($filters)->links() !!}
            @else
                {!! $products->links() !!}
                
            @endif
        </div>
    </div>
@stop
