@include('admin.includes.alerts')

<div class="form-group">
    <label>Nome:</label>
    <input class="form-control" type="text" name="name" placeholder="Nome:" value="{{ $user->name ?? old('name') }}">
</div>
<div class="form-group">
    <label>E-mail:</label>
    <input class="form-control" type="email" name="email" placeholder="E-mail:" value="{{ $user->email ?? old('email') }}">
</div>
<div class="form-group">
    <label>Senha:</label>
    <input class="form-control" type="password" name="password" placeholder="Senha:">
</div>

<div class="form-group">
    <button class="btn btn-dark" type="submit">Enviar</button>
</div>