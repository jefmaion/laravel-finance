@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-list    "></i>
                    Contas
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('account') }}">Contas</a></li>
                    <li class="breadcrumb-item active">Nova Conta</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-secondary card-outline">
        <div class="card-body">

            <form action="{{ route('account.store') }}" method="POST">
                @csrf
                @include('account.form')
                <a name="" id="" class="btn btn-secondary" href="{{ route('account.index') }}" role="button"> <i class="fas fa-chevron-circle-left    "></i> Voltar</a>
                <button type="submit" class="btn btn-success"> <i class="fas fa-save    "></i> Salvar</button>
            </form>
        </div>
    </div>
    
@stop

@section('css')

@stop

@section('js')

@stop



