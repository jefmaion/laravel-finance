@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-list    "></i>
                    Categorias
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Categorias</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')

    <style></style>

    <div class="card card-secondary card-outline">
        <div class="card-body">

            <div class="row no-gutters">
                <div class="col">
                    <a class="btn btn-success" href="{{ url('category/create') }}" role="button"><i class="fas fa-plus-circle"></i> Adicionar</a>
                </div>

                <div class="col">
                    <div class="form-group">
                        <input type="text" class="form-control" name="datatable-search" id="datatable-search" aria-describedby="helpId" placeholder="Pesquisar">
                    </div>
                </div>

            </div>
            
           
            <table class="table table-sm tablSe-striped">
                <thead class="thead-light">
                    <tr>
                        <th>Categoria</th>
                        <th>Subcategoria</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($categories as $category)
                        {{-- @include('category.tr', ['category' => $category]) --}}
                        <tr class="bg-light text-bold">
                            <td >{{  $category->name }}</td>
                            <td>{{  $category->name }}</td>
                            <td class="text-center">

                                <a name="" id="" class="btn btn-warning text-white btn-sm" href="{{ route('category.edit', $category) }}" role="button">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                        
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#my-modal-{{ $category->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <div class="modal" id="my-modal-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Excluir</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Deseja excluir esse registro?
                                            </div>
                                        
                                            <div class="modal-footer">
                                                <form action="{{ route('category.destroy', $category) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"> <i class="fas fa-stop-circle    "></i> Cancelar</button>
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Excluir</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                            </td>
                        </tr>

                        @foreach($category->subcategory as $sub)
                        <tr>
                            <td><?= $category->name ?></td>
                            <td>{{ $sub->name }}</td>
                            <td class="text-center">
                                
                                <a name="" id="" class="btn btn-warning text-white btn-sm" href="{{ route('category.edit', $sub) }}" role="button">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#my-modal-{{ $sub->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <div class="modal" id="my-modal-{{ $sub->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Excluir</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Deseja excluir esse registro?
                                            </div>
                                        
                                            <div class="modal-footer">
                                                <form action="{{ route('category.destroy', $sub) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"> <i class="fas fa-stop-circle    "></i> Cancelar</button>
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Excluir</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                            </td>
                        </tr>
                        @endforeach
                   @endforeach
                   {{-- <tr>
                       <td rowspan="3">Nome</td>
                       <td>Sub1</td>
                       <td>Acao1</td>
                   </tr> --}}
                   {{-- <tr>
                        <td>Sub2</td>
                        <td>Acao2</td>
                    </tr>
                    <tr>
                        <td>Sub2</td>
                        <td>Acao2</td>
                    </tr>

                    <tr>
                        <td rowspan="3">
                            Nome
                        </td>
                        <td>Sub1</td>
                        <td>Acao1</td>
                    </tr>
                    <tr>
                         <td>Sub2</td>
                         <td>Acao2</td>
                     </tr>
                     <tr>
                         <td>Sub2</td>
                         <td>Acao2</td>
                     </tr> --}}
                </tbody>
            </table>

           
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
@stop

@section('js')
    <script src="{{ asset('js/datatables.js') }}"></script>
@stop