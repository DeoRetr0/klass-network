<style>
    .sidenav {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 3;
        top: 0;
        left: 0;
        background-color: #004d40;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
    }
    #conteudoNav{
        padding: 20px;
        font-size: 20px;
        font-weight: bold;
    }

    a {
        text-decoration: none;
        transition: 0.3s;
        color: whitesmoke;
        margin-right: 10px;
    }

    a:hover {
        text-decoration: none;
        color: lightgrey;
    }

    .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }

    @media screen and (max-height: 450px) {
        .sidenav {padding-top: 15px;}
        .sidenav a {font-size: 18px;}
    }
</style>
</head>
<body>

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style="font-size: 25px; margin-top: 20px">Fechar &times;</a>
    <div id="conteudoNav">
    @if(Auth::check())
        <form class="navbar-form" role="search" action="{{route('search.results')}}">
            <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="Ache amigos...">
                <span class="input-group-btn">
                    <button class="btn btn-light" style="border-radius: 2px" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
            <br>
        <ul class="nav navbar-nav">
            <li><a href="{{route('home')}}">Timeline</a></li>
            <li><a href="{{route('friends.index')}}">Solicitações</a></li>
            <li style="margin-top: 3px"><a href="#">Notificações</a></li>
    @endif
    @if (Auth::check())
            <li><a href="{{route('profile.index', ['email'=>Auth::user()->email])}}">Ver
                    Perfil</a></li>
            <li><a href="#">Configurações</a></li>
            <div class="dropdown-divider"></div>
            <li><a href="{{route('auth.signout')}}">Sair</a></li>
            @else
                <li><a href="{{route('auth.login')}}">Logar</a></li>
                <li><a href="{{route('auth.signup')}}">Criar Conta</a></li>
            @endif
        </ul>
    </div>
</div>

<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
    }

    /* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
    var mq = window.matchMedia('(max-width: 425px)');
    if (mq.matches) {
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }
    } else {
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft = "100px";
        }
    }
</script>
