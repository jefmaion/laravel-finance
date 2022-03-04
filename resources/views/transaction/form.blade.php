
@csrf

<div class="row">

    <div class="col-3">
        <div class="form-group">
            <label for="exampleFormControlInput1">Data</label>
            <input type="date" class="form-control"  name="trans_date" value="{{ ($transaction->trans_date) ? $transaction->trans_date : date('Y-m-d') }}">
            <div class="invalid-feedback"></div>
        </div>
    </div>

    <div class="col-7">
        <div class="form-group">
            <label for="exampleFormControlInput1">Descrição</label>
            <input type="text" class="font-weight-bold text-secondary form-control form-conntrol-lg" id="description" autocomplete="off" value="{{ $transaction->description }}"  name="description">
            <div class="invalid-feedback"></div>
            <div class="border position-absolute w-100 bg-white" style="z-index:1000" id="search-box">
               <table id="table-description" class="table table-sm ">
                    @foreach($descriptionList as $desc)
                        <tr>
                            <td> <a href="#" class="smsall text-muted search-click">{{ $desc->description }}</a></td>
                        </tr>
                    @endforeach
               </table>
            </div>
        </div>
    </div>

    <div class="col-2">
        <div class="form-group">
            <label for="exampleFormControlInput1">Valor</label>
            <input type="text" class="font-weight-bold text-secondary form-control form-cojntrol-lg"  name="amount" value="{{ $transaction->amount }}">
            <div class="invalid-feedback"></div>
        </div>
    </div>

    <div class="col-3">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Tipo de Despesa</label>
            <select class="form-control select2" name="amount_type">
            <option></option>
            <option value="1" {{ ($transaction->amount_type == 1) ? 'selected' : ''  }}>Receita</option>
            <option value="2" {{ ($transaction->amount_type == 2) ? 'selected' : ''  }}>Despesa</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
    </div>

    
    

    <div class="col-9">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Categoria</label>
            <select class="form-control select2" name="category_id">
                <option></option>
                @foreach($categories as $category)

                <optgroup label="{{ $category->name }}" >

                    @if(count($category->subcategory) == 0)
                        <option value="{{ $category->id }}" {{ ($transaction->category_id == $category->id) ? 'selected' : ''  }}>{{ $category->name }}</option>             
                    @else
                        @foreach($category->subcategory as $sub)
                        <option  value="{{ $sub->id }}" {{ ($transaction->category_id == $sub->id) ? 'selected' : ''  }}>{{ $sub->name }}</option>
                        @endforeach  
                    @endif

                    </optgroup>
                    @endforeach
            </select>
            <div class="invalid-feedback"></div>
        </div>
    </div>

    <div class="col-4">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Conta</label>
            <select class="form-control select2" name="account_id">
                <option></option>
            @foreach($accounts as $account)
                <option value="{{ $account->id }}" {{ ($transaction->account_id == $account->id) ? 'selected' : ''  }}>{{ $account->name }}</option>
            @endforeach
            </select>
            <div class="invalid-feedback"></div>
        </div>  
    </div>

    <div class="col-4">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Forma</label>
            <select class="form-control select2" name="transaction_type_id">
                <option></option>
            @foreach($types as $type)
                <option value="{{ $type->id }}" {{ ($transaction->transaction_type_id == $type->id) ? 'selected' : ''  }}>{{ $type->name }}</option>
            @endforeach
            </select>
            <div class="invalid-feedback"></div>
        </div>  
    </div>

    <div class="col-4">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Pago?</label>
            <select class="form-control select2" name="executed">
            <option></option>
            <option value="1" {{ ($transaction->executed == 1) ? 'selected' : ''  }}>Sim</option>
            <option value="0" {{ ($transaction->executed == 0) ? 'selected' : ''  }}>Não</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
    </div>

    

</div>




        

    <div class="form-group">
      <label for="exampleFormControlTextarea1">Observação</label>
      <textarea class="form-control" name="comments" rows="2">{{ $transaction->comments }}</textarea>
    </div>




<script>

    $('.select2').select2({
        theme:"bootstrap4",
        placeholder: "Selecione uma opção",
        tags: true
    });


    $(document).ready(function(){

        $('#search-box').hide();

        $("#description").on("keyup", function() {
            var value = $(this).val().toLowerCase();

            if(value == '') {
                $('#search-box').hide();
                return 
            }



            $("#table-description tr").filter(function() {
                if($(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)) {
                    $('#search-box').show();
                    return
                } 
                $('#search-box').hide();
            });

            
        });

        $('.search-click').click(function() {
            var value = $(this).html()
            $('#description').val(value);
            $('#search-box').hide();
            return;
        });
    });
</script>