<div>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->

{{-- 
  <div class="row no-gutters">

        <div class="col">
            <a class="btn btn-success" href="{{ route($route . '.create') }}" role="button"><i class="fas fa-plus-circle"></i> Adicionar</a>
        </div>

        <div class="col">
            <div class="form-group">
                <input type="text" class="form-control" name="datatable-search" id="datatable-search" aria-describedby="helpId" placeholder="Pesquisar">
            </div>
        </div>

    </div> --}}


    <div class="form-row align-items-center">

        <div class="col-auto">
            <a class="btn btn-success" href="{{ route($route . '.create') }}" role="button"><i class="fas fa-plus-circle"></i> Adicionar</a>
        </div>

        <div class="col">
            <input type="text" class="form-control" name="datatable-search" id="datatable-search" aria-describedby="helpId" placeholder="Pesquisar">
        </div>

        
      </div>

            
           
    <table class="table table-sm table-striped">
        
        <thead class="thead-light">
            <tr>
                
                @foreach($header as $key => $value)
                <th>{{ $value }}</th>
                @endforeach

                <th class="text-center">Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach($dataList as $item)
                <tr>

                    @foreach($header as $key => $value)
                    <td>{{  $item->{$key} }}</td>
                    @endforeach

                    <td class="text-center">

                        <a name="" id="" class="btn btn-warning text-white btn-sm" href="{{ route($route . '.edit', $item) }}" role="button">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#my-modal-{{ $item->id }}">
                            <i class="fas fa-trash"></i>
                        </button>

                        <div class="modal" id="my-modal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
                                        <form action="{{ route($route . '.destroy', $item) }}" method="POST">
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

</div>

@section('css')
    <link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
@stop

@section('js')
    <script src="{{ asset('js/datatables.js') }}"></script>
@stop