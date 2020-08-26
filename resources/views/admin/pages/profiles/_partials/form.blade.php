@include('admin.includes.alerts')

<div class="form-group">
    <label>* Nome:</label>
    <input class="form-control" type="text" name="name" placeholder="Nome:" value="{{ $profile->name ?? old('name') }}">
</div>
<div class="form-group">
    <label>Descrição:</label>
    <input class="form-control" type="text" name="description" placeholder="Descrição:" value="{{ $profile->description ?? old('description') }}">
</div>
<div class="form-group">
    <button class="btn btn-dark" type="submit">Enviar</button>
</div>