<div class="form-group">
  <label for="">Nome da Categoria</label>
  <input type="text" class="form-control {{ ($errors->has('name')) ? 'is-invalid' : '' }}" name="name" value="{{ old('name', $category->name) }}" aria-describedby="helpId" placeholder="">
  @if($errors->has('name'))
    <div class="invalid-feedback">
        {{ $errors->first('name') }}
    </div>
    @endif
</div>

<div class="form-group">
  <label for="">Categoria</label>
  <select class="form-control" name="category_id">
    <option></option>
   @foreach($categories as $cat)
   <option value="{{ $cat->id }}" {{ ($cat->id == $category->category_id) ? 'selected' : '' }}>{{ $cat->name }}</option>
   @endforeach
  </select>
</div>