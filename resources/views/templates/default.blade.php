<!doctype html>
<html lang="pt-br">
<head>
    <link rel="shortcut icon" type="image/ico" href="favicon.ico"/>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Righteous&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Concert+One&family=Odibee+Sans&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/982d993f59.js" crossorigin="anonymous"></script>
    <title>Klass /
        @if($view_name == "Perfil")
{{--            {{$view_name.' @'.$post ?? ''->user->username}}--}}
            {{$view_name.' @'. $user->username}}
        @else
            {{$view_name}}
        @endif
    </title>
    <style>
        /* CSS BASE DOS TEMAS */
        :root {
            --primary-color: #0288D1;
            --secondary-color: #607D8B;
            --card-color: whitesmoke;
            --font-color: #FFFFFF;
            --hover-color: #CFD8DC;
            --bg-color: whitesmoke;
            --textarea-color: whitesmoke;
            --primaryText-color: #212121;
            --secondaryText-color: #757575;
        }
        [data-theme="dark"] {
            --primary-color: #161625;
            --secondary-color: #565f78;
            --card-color: #3b404f;
            --font-color: #FFFFFF;
            --bg-color: #161625;
            --textarea-color: #757575;
            --primaryText-color: #FFFFFF;
            --secondaryText-color: whitesmoke;
            font-weight: bolder;
        }
        /* CSS GERAL DE TODAS AS PAGINAS */
        body {
            background-color: var(--bg-color);
            color: var(--primaryText-color);
            overflow-x: hidden;
        }
        /* CSS DO QUE É CARREGADO (VIEWS) -- NÃO CONTA A SIDENAV*/
        .conteudoCarregado{
            margin-left: 320px;
        }
        /* CSS MOBILE */
        .navbar{
            display: none;
        }
        @media only screen and (max-width: 725px) {
            .navbar{
                display: block;
                margin: -10px;
                bottom: 10px;
                background-color: var(--primary-color);
                border-bottom: 0.1ex solid white;
            }
            .conteudoCarregado{
                margin-left: 20px;
                margin-right: 20px;
                padding: 10px;
            }
            #barra2{
                display: none;
            }
            #buscar{
                width: 80%;
                margin-top: 20px;
            }
            .navbar .row{
                padding-left: 20px;
            }
            .navbar li{
                font-size: 20px;
                padding-left: 10px;
                list-style-type:none;
            }
            .navbar ul{
                margin-top: 10px;
            }
            button.navbar-toggler {
                width: 35px;
                height: 35px;
                margin-top: 20px;
                margin-left: 20px;
                background-color: var(--hover-color);

            }
            span.navbar-toggler-icon{
                height: 20px;
                width: 20px;
                margin-left: -5px;
            }
            #topo {
                position: fixed;
                bottom: 20px;
                right: 30px;
                z-index: 5;
                border: none;
                outline: none;
                background-color: dimgrey;
                color: var(--font-color);
                cursor: pointer;
                padding: 10px;
                border-radius: 10px;
                font-size: 15px;
            }
        }
    </style>
    <script>
        const currentTheme = localStorage.getItem('theme') ? localStorage.getItem('theme') : null;
        if (currentTheme) {
            document.documentElement.setAttribute('data-theme', currentTheme);

            if (currentTheme === 'dark') {
                toggleSwitch.checked = true;
            }
        }
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="row">
        @if(Auth::check())
            <form id="buscar" class="navbar-form" role="search" action="{{route('search.Buscar')}}">
                <div class=" bg-light rounded shadow-sm">
                    <div class="input-group">
                        <input type="text" name="query" placeholder="Ache amigos..." aria-describedby="button-addon1" class="form-control border-0 bg-light">
                        <div class="input-group-append">
                            <button class="btn btn-light" style="border-radius: 2px" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        @endif
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="navbarNav">
        @if(Auth::check())
        <ul class="nav navbar-nav">
            <li><a href="{{route('home')}}">Página Inicial</a></li>
            <li><a href="{{route('friends.Solicitações')}}">Solicitações</a></li>
            <li style="margin-top: 3px"><a href="#">Notificações</a></li>
            @endif
            @if (Auth::check())
                <li><a href="{{route('profile.Perfil', ['username'=>Auth::user()->username])}}">Perfil</a></li>
                <li><a href="{{route('config.Config')}}">Configurações</a></li>
                <div class="dropdown-divider"></div>
                <li><a href="{{route('auth.signout')}}">Sair</a></li>
            @else
                <li><a href="{{route('auth.Login')}}">Logar</a></li>
                <li><a href="{{route('auth.SignUp')}}">Criar Conta</a></li>
            @endif
        </ul>
    </div>
</nav>
<div class="row">
    <span id="barra2">
        @include('templates.partes.nav')
    </span>
    <div class="conteudoCarregado col-sm-12 col-lg-8">
        @include('templates.partes.alerts')
        @yield('conteudo')
    </div>
</div>
<button onclick="topFunction()" id="topo" title="Voltar ao topo"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>
