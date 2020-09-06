@include('admin.includes.alerts')

<div class="form-group">
    <label>Identificador da Mesa:</label>
    <input class="form-control" type="text" name="identify" placeholder="Identificador da Mesa:" value="{{ $table->identify ?? old('identify') }}">
</div>
<div class="form-group">
    <label>Descrição</label>
    <textarea class="form-control" name="description" cols="30" rows="5">{{ $table->description ?? old('description') }}</textarea>
</div>

<div class="form-group">
    <button class="btn btn-dark" type="submit">Enviar</button>
</div>