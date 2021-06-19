@extends('templates.default')
@section('pageTitle', 'Redefinir Senha')
@section('conteudo')
<style>
#container-total {
    padding: 100px;
    height: 100%;
}

#esqueciSenha {
    background-color: var(--secondary-color);
    color: white;
    font-family: 'Josefin Sans', sans-serif;
}
</style>
<div class="container" id="container-total">
    <div class="card" id="esqueciSenha">
        <div class="card-header">Redefinir Senha</div>
        <div class="card-body">
            <form method="POST" action="/reset-password">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <label for="email" class="form-label text-md-right">E-Mail</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $info }}</strong>
                        </span>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label text-md-right">Senha</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password"
                            autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $info }}</strong>
                        </span>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="form-label text-md-right">Confirmar Senha</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            autocomplete="new-password">
                </div>

                <div class="form-group">
                    <div>
                        <button type="submit" class="btn btn-light">
                            Salvar Alteração
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop