<div class="form-group">
  <label for="">Nome</label>
  <input type="text" class="form-control {{ ($errors->has('name')) ? 'is-invalid' : '' }}" name="name" value="{{ old('name', $account->name) }}" aria-describedby="helpId" placeholder="">
  @if($errors->has('name'))
    <div class="invalid-feedback">
        {{ $errors->first('name') }}
    </div>
    @endif
</div>
