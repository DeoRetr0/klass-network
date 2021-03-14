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
    <title>
        @if($view_name == "Perfil" )
{{--            {{$view_name.' @'.$post ?? ''->user->username}}--}}
            {{'@'.$username}}
        @else
            {{$view_name}}
        @endif
        / Klass
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
            color: var(--primaryText-color) !important;
            color: var(--primaryText-color);
            overflow-x: hidden;
        }
        /* CSS DO QUE É CARREGADO (VIEWS) -- NÃO CONTA A SIDENAV*/
        .conteudoCarregado{
            
        }
        /* CSS MOBILE */
        .navbar{
            display: none;
        }
        footer{
            display: none;
        }
        @media only screen and (max-width: 725px) {
            .trending{
                display: none;
            }
            .navbar{
                display: block;
                position: fixed;
                z-index: 5;
                width: 100%;
                background-color: var(--primary-color);
                border-bottom: 0.1ex solid white;
                margin-top: -15px;
            }
            .conteudoCarregado{
                margin-top: 45px;
                width: 90%;
                margin-left: 20px;
                margin-bottom: 50px;
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
            #topo {
                position: fixed;
                bottom: 75px;
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
            span{
                background-color: red;
                border-radius: 10px;
                font-size: 8px;
                padding: 5px;
                margin-bottom: 20px;
                position: absolute;
                margin-left: 10px;
            }
            footer{
                display: block;
                background-color: var(--bg-color);
                color: var(--primaryText-color);
                text-align: center;
            }
            footer ul{
                padding-top: 10px;
                margin-left: -30px;
            }
            footer li{
                display: inline;
                margin: 10px;
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
        <ul style="display: inline" class="nav navbar-nav">
            @if (Auth::check())
                <li><a href="{{route('auth.signout')}}">
                        <button style="border-radius: 25px; margin-top: 12px;" class="btn"><i class="fas fa-sign-out-alt fa-lg"></i></button>
                    </a></li>
            @else
                <li style="display: inline"><a href="{{route('auth.Login')}}">
                        <button style="border-radius: 25px; margin-bottom: 5px" class="btn">Logar</button>
                    </a></li>
                <li style="display: inline"><a href="{{route('auth.SignUp')}}">
                        <button style="border-radius: 25px; margin-bottom: 5px" class="btn">Criar Conta</button>
                    </a></li>
            @endif
        </ul>
    </div>
</nav>
<div class="row">
    <div class="col-sm-12 col-lg-3">
        @include('templates.partes.nav')
    </div>
    <div class="conteudoCarregado col-sm-12 col-lg-6">
        @include('templates.partes.alerts')
        @yield('conteudo')
    </div>
    @if (Auth::check())
    <div class="trending col-sm-12 col-lg-3">
        @include('templates.partes.right')
    </div>
        <footer class="fixed-bottom">
            <ul>
                <li>
                    <a href="{{route('profile.Perfil', ['username'=>Auth::user()->username])}}">
                        <i class="fas fa-user"></i>
                    </a>
                </li>
                <li>
                    @if ( !$friendRequests->count())
                        <a href="{{route('friends.Solicitações')}}"><i class="fas fa-users"></i></a>
                    @else
                        <span>{{$friendRequests->count()}}</span><a href="{{route('friends.Solicitações')}}"><i class="fas fa-users"></i></a>
                    @endif
                </li>
                <li>
                    <a href="{{route('home')}}">
                        <button style="border-radius: 25px; background-color: var(--primary-color); color: var(--primaryText-color)" class="btn"><i class="fa fa-home fa-lg"></i></button>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-bullhorn"></i>
                    </a>
                </li>
                <li><a href="{{route('config.Config')}}">
                        <i class="fas fa-cogs"></i>
                    </a></li>
            </ul>
        </footer>
    @endif
</div>
<button onclick="topFunction()" id="topo" title="Voltar ao topo"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>
