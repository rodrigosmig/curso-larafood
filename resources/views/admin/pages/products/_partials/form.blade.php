@include('admin.includes.alerts')

<div class="form-group">
    <label>Title:</label>
    <input class="form-control" type="text" name="title" placeholder="Título:" value="{{ $product->title ?? old('title') }}">
</div>
<div class="form-group">
    <label>* Preço:</label>
    <input class="form-control" type="text" name="price" placeholder="Preço:" value="{{ $product->price ?? old('price') }}">
</div>
<div class="form-group">
    <label>* Imagem:</label>
    <input class="form-control" type="file" name="image">
</div>
<div class="form-group">
    <label>Descrição</label>
    <textarea class="form-control" name="description" cols="30" rows="5">{{ $product->description ?? old('description') }}</textarea>
</div>

<div class="form-group">
    <button class="btn btn-dark" type="submit">Enviar</button>
</div>