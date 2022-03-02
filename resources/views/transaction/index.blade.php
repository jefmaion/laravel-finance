@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-list    "></i>
                    Lançamentos
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Lançamentos</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')

    <div class="row">

        <div class="col-9">
            <div class="card card-secondary card-outline">
                <div class="card-body">

                   
                   
                    <div class="row mb-3">
                        <div class="col-7">
                            <div class="form-row align-items-center">

                                <div class="col-auto">
                                    <a class="btn btn-success" href="#" data-toggle="modal" data-target="#modal-transaction" data-id="0" role="button"><i class="fas fa-plus-circle"></i> Adicionar</a>
                                </div>
        
                                <div class="col">
                                    <input type="text" class="form-control" name="datatable-search" id="datatable-search" aria-describedby="helpId" placeholder="Pesquisar">
                                </div>
    
                              </div>
                        </div>

                        <div class="col">
                            <div class="form-row align-items-center">

                              
        
                                <div class="col">
                                    <input type="text" class="form-control" name="" id="datatable-search" aria-describedby="helpId" placeholder="Data Inicial">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="" id="datatable-search" aria-describedby="helpId" placeholder="Data Final">
                                </div>
                                <div class="col-auto">
                                    <a class="btn btn-primary btn-block" href="#" role="button"><i class="fas fa-plus-circle"></i></a>
                                </div>
    
                              </div>
                        </div>
                    </div>
                    

                    <table class="mt-4 table table-striped table-bordered table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th>Data</th>
                                <th>Descrição</th>
                                <th class="text-center">Receita/Despesa</th>
                                <th>Categoria</th>
                                <th>Conta</th>
                                <th class="text-center">Valor</th>
                                <th>Status</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                            <tr >
                                <td>{{ $transaction->transDateBR }}</td>
                                <td >
                                    <span data-toggle="tooltip" data-placement="top" title="{{$transaction->comments}}">{{ $transaction->description }}</span>{{($transaction->comments) ? "*" : ""}}
                                    
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-{{ $transaction->amountTypeClass }}">{{ $transaction->amountTypeText }}</span>
                                </td>
                                <td>{{ $transaction->category->name }}</td>
                                <td>{{ $transaction->account->name }}</td>
                                <td class="text-right text-{{ $transaction->amountTypeClass }}">
                                    <strong>
                                    {{ $transaction->amount }}
                                    </strong>
                                </td>
                                <td class="text-center">
                                    {{-- <span class="badge badge-pill badge-{{ $transaction->executedClass }}">{{ $transaction->executedStatus }}</span> --}}
                                    @if($transaction->executed)
                                        <i class="text-info fas fa-check-circle    "></i>
                                    @else
                                        <i class="text-secondary fas fa-circle    "></i>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a name="" id="" class="btn btn-warning text-white btn-sm" href="#" data-toggle="modal" data-target="#modal-transaction" data-id="{{ $transaction->id }}" role="button">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>

                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#my-modal-{{ $transaction->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
            
                                    <div class="modal" id="my-modal-{{ $transaction->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
                                                    <form action="{{ route('transaction.destroy', $transaction) }}" method="POST">
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

                         
                        </tbody>
                        
                    </table>

                    <hr>

        
                </div>
            </div>
        </div>


        <div class="col">

            <div class="card card-secondary card-outline">
                <div class="card-body">
                    <p><b>Resumo do Período</b></p>
                    
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <td>Receitas</td>
                                <td class="text-right text-success font-weight-bold">R$ {{ $resume[0]->amount }}</td>
                            </tr>
                            <tr>
                                <td>Despesas</td>
                                <td class="text-right text-danger font-weight-bold">R$ {{ $resume[1]->amount }}</td>
                            </tr>
                            <tr class="bg-light">
                                <td>Saldo</td>
                                <td class="text-right">R$ {{ $resume[0]->amount - $resume[1]->amount }}</td>
                            </tr>
                        </tbody>
                    </table>

                 
                </div>
            </div>
            <div class="card card-secondary card-outline">
                <div class="card-body">
                    <p><b>Resumo Por Categoria</b></p>

                    <table class="table table-sm">
                      
                        <tbody>
                            @foreach($resumeCategory as $cat)
                            <tr>
                                <td>
                                    {{ $cat->name }}
                                    {{-- <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div> --}}
                                </td>
                             
                                <td class="text-right">R$ {{ $cat->amount }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                      
                    </table>
                </div>
            </div>

            
        </div>

    </div>



    
    <!-- Modal -->

        <div class="modal fade" id="modal-transaction"  role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title">Lançamentos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" onClick="createTransaction()">Cadastrar Lançamento</button>
                    </div>
                </div>
            </div>
        </div>
 

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
@stop

@section('js')
    <script src="{{ asset('js/datatables.js') }}"></script>

    <script>

        $('[data-toggle="tooltip"]').tooltip()

        $('#modal-transaction').on('show.bs.modal', function (event) {
            var modal = $(this);
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('id') // Extract info from data-* attributes

            $.ajax({
                type: "GET",
                url: "{{ route('transaction.form', "") }}/" + recipient,
                success: function (response) {
                    $('#modal-transaction .modal-body').html(response)
                }
            });
        })

        function createTransaction() {
            var form = $('#form-transaction');

            $.ajax({
                type: $(form).attr('method'),
                url: $(form).attr('action'),
                data: $(form).serialize(),
                dataType: 'json',
                error:function(response, status, error) {

                   alert(response.responseJSON.message)
                   
                    if(response.responseJSON.errors) {

                        $('input, select').removeClass('is-invalid')

                        $.each(response.responseJSON.errors, function (field, message) { 
                            $('input[name="'+field+'"], select[name="'+field+'"]').addClass('is-invalid').siblings('.invalid-feedback').html(message)
                        });

                        return
                    }   

                },
                success: function (response) {


                    location.reload();
                }
            });
        }

    </script>
@stop