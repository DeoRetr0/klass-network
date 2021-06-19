@extends('templates.default')
@section('pageTitle', 'Esqueci minha Senha')
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
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="/forget-password">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label text-md-right">E-Mail</label>
                    <div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $info }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <button type="submit" class="btn btn-light">
                            Enviar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop