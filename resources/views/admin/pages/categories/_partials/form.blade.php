@include('admin.includes.alerts')

<div class="form-group">
    <label>Nome:</label>
    <input class="form-control" type="text" name="name" placeholder="Nome:" value="{{ $category->name ?? old('name') }}">
</div>
<div class="form-group">
    <label>Descrição</label>
    <textarea class="form-control" name="description" cols="30" rows="5">{{ $category->description ?? old('description') }}</textarea>
</div>

<div class="form-group">
    <button class="btn btn-dark" type="submit">Enviar</button>
</div>