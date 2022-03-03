<form id="form-transaction" method="POST" action="{{ route('transaction.store') }}">
@include('transaction.form')

<p><b>Repetir</b></p>
<hr>

<div class="row">

    <div class="col-4">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Período</label>
            <select class="form-control select2" name="repeat_type">
            <option></option>
            <option value="week">Semanalmente</option>
            <option value="months">Mensalmente</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
    </div>

    <div class="col-4">
        <div class="form-group">
            <label for="exampleFormControlInput1">Repetir (vezes)</label>
            <input type="text" class="font-weight-bold text-secondary form-control" value=""  name="repeat_times">
            <div class="invalid-feedback"></div>
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Forma</label>
            <select class="form-control select2" name="repeat_transaction_type_id">
                <option></option>
            @foreach($types as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
            </select>
            <div class="invalid-feedback"></div>
        </div>
    </div>
    
</div>

</form>


@section('js')
    
@stop