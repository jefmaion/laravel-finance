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
                    <li class="breadcrumb-item active">Contas</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')

    <style></style>

    <div class="card card-secondary card-outline">
        <div class="card-body">
            <x-table route="account" :header="['name' => 'Nome']" :data="$accounts"/>
        </div>
    </div>
@stop

