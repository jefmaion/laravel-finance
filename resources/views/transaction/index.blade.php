@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="m-0">
                    <i class="fas fa-list    "></i>
                    Lançamentos
                </h1>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <select class="form-control select2" onchange="selectPeriod(this.value)" name="" id="select-month">
                      <option></option>
                      @foreach($range as $item)
                      <option value="{{ $item['start'] }}/{{ $item['end'] }}" {{ $item['select'] }}> {{ $item['label'] }}</option>
                      @endforeach
                    </select>
                  </div>
            </div>
        </div>
    </div>
@stop

@section('content')

    <div class="row">

        <div class="col-12">
            <div class="card card-secondary card-outline">
                <div class="card-body">

                   
                   
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-row align-items-center">

                                <div class="col-auto">
                                    <div class="dropdown open">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                    Com Selecionados
                                                </button>
                                        <div class="dropdown-menu" aria-labelledby="triggerId">
                                            <button class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-delete-all">Excluir</button>
                                            <button class="dropdown-item disabled" href="#">Disabled action</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <a class="btn btn-success" href="#" data-toggle="modal" data-target="#modal-transaction" data-id="0" role="button"><i class="fas fa-plus-circle"></i> Adicionar</a>
                                </div>
        
                                <div class="col">
                                    <input type="text" class="form-control" name="datatable-search" id="datatable-search" aria-describedby="helpId" placeholder="Pesquisar">
                                </div>
    
                              </div>
                        </div>

     
                    </div>
                    
                    <form id="form-container"> 
                        @csrf
                    <table class="mt-4 table table-stripsed tablse-bordered table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check-all-transaction">
                                        <label class="custom-control-label" for="check-all-transaction"></label>
                                      </div>
                                </th>
                                <th class="text-center">Tipo</th>
                                <th>Data</th>
                                
                                <th>Descrição</th>
                                {{-- <th class="text-center">Receita/Despesa</th> --}}
                                <th class="text-center">Categoria</th>
                                <th class="text-right">Valor</th>
                                <th class="text-center">Situação</th>
                                <th class="text-center">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                            <tr class="{{ ($transaction->executed == 0) ? 'text-gray disabled' : '' }}">
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input check-transaction" name="transaction[]" value="{{ $transaction->id }}" id="check-transaction-{{ $transaction->id }}">
                                        <label class="custom-control-label" for="check-transaction-{{ $transaction->id }}"></label>
                                      </div>
                                </td>
                                <td class="text-center">
                                    <i style="font-size:10px" class="fas fa-circle    text-{{ $transaction->amountTypeClass }}"></i>
                                </td>
                                <td>{{ $transaction->transDateBR }}</td>
                              
                                <td >
                                    <span data-toggle="tooltip" data-placement="top" title="{{$transaction->comments}}">
                                        {{ $transaction->description }}
                                    </span>{{($transaction->comments) ? "*" : ""}}
                                    
                                </td>
                                {{-- <td class="text-center">
                                    <span class="badge badge-pill badge-{{ $transaction->amountTypeClass }}">{{ $transaction->amountTypeText }}</span>
                                </td> --}}
                                <td class="text-center">
                                    <span class="text-secondary badge badge-pill border border-secondary">{{ $transaction->category->name }}</span>
                                    </td>
                                <td class="text-right text-{{ $transaction->amountTypeClass }}">
                                    R$ {{ $transaction->amount }}
                                </td>
                                <td class="text-center">
                                    {{-- <span class="badge badge-pill badge-{{ $transaction->executedClass }}">{{ $transaction->executedStatus }}</span> --}}
                                    @if($transaction->executed)
                                        <i class="text-success fas fa-thumbs-up    "></i>
                                    @else
                                        <i class="text-gray fas fa-thumbs-down    "></i>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="dropdown show">
                                        
                                        <a class="text-muted" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-angle-down    "></i>
                                        </a>
                                      
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-transaction" data-id="{{ $transaction->id }}" role="button">
                                                <i class="fas fa-pencil-alt"></i> Editar
                                            </a>

                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#my-modal-{{ $transaction->id }}">
                                                <i class="fas fa-trash"></i> Excluir
                                            </a>
                                        </div>

                                        {{-- modal excluir --}}
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

                                      </div>
                                </td>

                            </tr>
                            @endforeach

                         
                        </tbody>
                        
                    </table>
                    </form>
                    <hr>

        
                </div>
            </div>
        </div>


        {{-- <div class="col">

            <div class="card card-secondary card-outline">
                <div class="card-body">
                    <p><b>Resumo do Período</b></p>

  
                    
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <td>Receitas</td>
                                <td class="text-right text-success font-weight-bold">R$ {{ (isset($resume[0])) ? $resume[0]->amount : 0 }}</td>
                            </tr>
                            <tr>
                                <td>Despesas</td>
                                <td class="text-right text-danger font-weight-bold">R$ {{ (isset($resume[1])) ? $resume[1]->amount : 0 }}</td>
                            </tr>
                            <tr class="bg-light">
                                <td>Saldo</td>
                                <td class="text-right">R$ </td>
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
                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </td>
                             
                                <td class="text-right">R$ {{ $cat->amount }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                      
                    </table>
                </div>
            </div>

            
        </div> --}}

    </div>



    
    <!-- Modal -->

        <div class="modal fade" id="modal-transaction"  role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
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

        <div class="modal" id="modal-delete-all" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Excluir</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Deseja excluir todos os registros selecionados?
                    </div>
                
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"> <i class="fas fa-stop-circle    "></i> Cancelar</button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="testeAll()"><i class="fas fa-trash"></i> Excluir</button>
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
    <script src="{{ asset('js/select2.js') }}"></script>

    <script>

        $('[data-toggle="tooltip"]').tooltip()

        $('#check-all-transaction').click(function() {
            $('.check-transaction').prop('checked', $(this).prop('checked'))
        });

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

        function selectPeriod(val) {
            window.location.href = '{{ route('transaction.index') }}/' + val;
        }

        function testeAll() {
            $.ajax({
                type: "POST",
                url: "{{ route('transaction.deleteAll') }}",
                data: $('#form-container').serialize(),
                dataType: "json",
                success: function (response) {
                    location.reload();
                }
            });
        }

    </script>
@stop