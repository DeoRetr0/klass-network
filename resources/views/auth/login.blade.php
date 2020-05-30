@extends('templates.default')

@section('conteudo')
    <style>
        body {
            background-color: #212121;
            color: whitesmoke;
        }

        .container {
            font-family: 'Josefin Sans', sans-serif;
            margin-top: 50px;
            width: fit-content;
            height: auto;
            background-color: #004d40;
            color: white;
            text-align: center;
            padding: 10px;
        }

        h2 {
            padding: 5px;
            margin: 10px;
            font-family: 'Righteous', cursive;
            color: white;
            font-size: 40px;
            text-align: center;
        }

        .info {
            margin-left: 35px;
            text-align: center;
        }

        table > tr, td {
            padding: 10px;
        }
        .btn{
            margin: 10px;
        }
        .tag{
            margin-left: 80px;
        }
    </style>
    <form method="POST" action="{{route('auth.login')}}" class="form-group">
        <div class="container" id="top-menu">
            <table>
                <div class="row">
                    <div class="col">
                        <tr>
                            <h2>Acesse seu Perfil</h2>
                        </tr>
                    </div>
                    <div class="col">
                            <tr class="row info">
                                <td>
                                    <label>Login:</label>
                                </td>
                                <td>
                                    <input required class="form-control" type="text" name="email" placeholder="Email">
                                </td>
                            </tr>
                            <tr class="row info">
                                <td>
                                    <label>Senha:</label>
                                </td>
                                <td>
                                    <input required class="form-control" type="password" name="password" placeholder="Senha">
                                </td>
                            </tr>
                        <tr class="row tag">
                            <td>
                                <input type="checkbox" name="rememberMe" id="rememberMe">
                                <label for="rememberMe">Lembre-se de Mim</label><br>
                            <a href="#">Esqueci minha senha!</a></td>

                        </tr>
                    </div>
                </div>
            </table>
            <div class="col">
                <button type="submit" name="entrar" class="btn btn-light">Iniciar Sessão</button>
                <input type="hidden" name="_token" value="{{Session::token()}}">
            </div>
        </div>
    </form>
    </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@stop
