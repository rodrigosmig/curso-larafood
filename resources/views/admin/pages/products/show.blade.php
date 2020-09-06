@extends('adminlte::page')

@section('title', "Detalhes do Plano {$product->name}")

@section('content_header')
    <h1>Detalhes do Produto <b>{{ $product->name }}</b></h1> 
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <td>
                    <img src="{{ url("storage/{$product->image}") }}" alt="{{ $product->title }}" style="max-width: 90px">
                </td>
                <li>
                    <strong>Title:</strong> {{ $product->name }}
                </li>
                <li>
                    <strong>Flag:</strong> {{ $product->flag }}
                </li>
                <li>
                    <strong>Descrição:</strong> {{ $product->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">DELETAR</button>
            </form>
        </div>
    </div>
@endsection
