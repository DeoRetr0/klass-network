@extends('templates.default')

@section('conteudo')
    <style>
        .container{
            font-family: 'Josefin Sans', sans-serif;
            margin-top: 100px;
            width: fit-content;
            height: auto;
            background-color: var(--primary-color);
            color: var(--font-color);
        }
        h1{
            padding: 5px;
            margin: 10px;
            font-family: 'Righteous', cursive;
            color: var(--font-color);
            font-size: 60px;
            text-align: center;
        }
        #buttons{
            text-align: center;
            padding-bottom: 20px;
        }
    </style>
    <div class="container">
        <h1>Finalize seu cadastro!</h1>
        <form action="{{route('auth.SignUp')}}" method="POST">
            <div class="form-row">
                <div class="form-group col-sm {{ $errors->has('nome') ? 'has-error' : '' }}">
                    <label for="inputNome">Nome:</label>
                    <input required type="text" class="form-control" id="inputNome" placeholder="Nome" maxlength="15" name="nome">
                </div>
                <div class="form-group col-sm {{ $errors->has('sobrenome') ? 'has-error' : '' }}">
                    <label for="inputSobrenome">Sobrenome:</label>
                    <input required type="text" class="form-control" id="inputSobrenome" placeholder="Sobrenome" maxlength="15" name="sobrenome">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm">
                    <label id="inputFaculdade">Faculdade:</label>
                    <select class="form-control" name="faculdade" id="ie" required>
                        {{$fac = DB::table('faculdades')->pluck('faculdade')}}
                        @foreach($fac as $faculdade)
                            <option value="{{$faculdade}}">{{$faculdade}}</option>
                        @endforeach
                        </select>
                </div>
                <div class="form-group col-sm">
                    <label id="inputCurso">Curso:</label>
                    <select class="form-control" name="curso" id="cursos" required>
                        {{$cur = DB::table('cursos')->pluck('curso')}}
                        @foreach($cur as $curso)
                            <option value="{{$curso}}">{{$curso}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm">
                    <label id="inputDataNascimento">Data de Nascimento:</label>
                    <input required type="date" class="form-control" id="inputDataNascimento" placeholder="Data de Nascimento" name="dataNascimento" required>
                </div>
                <div class="form-group col-sm">
                    <label id="inputSenha">Senha:</label>
                    <input required type="password" class="form-control" id="inputSenha" placeholder="Senha" minlength="8" name="password">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm">
                    <label for="inputEmail">Email:</label>
                    <input required type="email" class="form-control" id="inputEmail" placeholder="Email" name="email">
                </div>
                <div class="form-group col-sm">
                    <label for="inputUsername">Tag:</label>
                    <input required type="text" class="form-control" id="inputUsername" name="username" placeholder="Apelido">
                </div>
            </div>
            <div id="buttons">
                <button type="submit" name="cadastrar" value="Cadastrar"class="btn btn-light">Cadastrar</button>
            </div>
            <input type="hidden" name="_token" value="{{Session::token()}}">
        </form>
    </div>
@stop
