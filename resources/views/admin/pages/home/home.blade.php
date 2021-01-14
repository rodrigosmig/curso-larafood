@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1> 
@stop

@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Usuários</span>
                    <span class="info-box-number">
                        {{ $totalUsers }}
                    </span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-tablet"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Mesas</span>
                    <span class="info-box-number">
                        {{ $totalUsers }}
                    </span>
                </div>
            </div>
        </div>

        @admin()
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-layer-group"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Categories</span>
                    <span class="info-box-number">
                        {{ $totalCategories }}
                    </span>
                </div>
            </div>
        </div>
        @endadmin()
    </div>
@endsection
