@extends('adminlte::page')

@section('title', "Detalhes do Plano {$category->name}")

@section('content_header')
    <h1>Detalhes da Categoria <b>{{ $category->name }}</b></h1> 
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome:</strong> {{ $category->name }}
                </li>
                <li>
                    <strong>URK:</strong> {{ $category->url }}
                </li>
                <li>
                    <strong>Description:</strong> {{ $category->description }}
                </li>
            </ul>

            @include('admin.includes.alerts')

            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">DELETAR</button>
            </form>
        </div>
    </div>
@endsection
