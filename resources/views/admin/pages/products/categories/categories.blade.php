@extends('adminlte::page')

@section('title', "Categorias do produto {$product->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li>
            <a class="breadcrumb-item" href="{{ route('admin.index') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ route('products.index') }}">Produtos</a>
            <a class="breadcrumb-item active" href="{{ route('products.categories', $product->id) }}">Categorias</a>
        </li>
    </ol>

    <h1>Categorias do produto <strong>{{ $product->title }}</strong> <a href="{{ route('products.categories.available', $product->id) }}" class="btn btn-dark">ADD Categoria</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <th>Nome</th>
                    <th>Ações</th>
                </thead>

                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td>
                                <a href="{{ route('products.categories.detach', [$product->id, $category->id]) }}" class="btn btn-danger">Desvincular</a>
                            </td>
                        </tr>
                    @endforeach
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
