<script src="https://kit.fontawesome.com/982d993f59.js" crossorigin="anonymous"></script>
<style>
    /* CSS DA BARRA LATERAL */
    .sidenav {
        background-color: var(--primary-color);
        position: fixed;
        height: 100%;
        padding: 10px;
        top: 0;
        border-right: solid 1px var(--font-color);
    }

    #navbarContent {
        font-size: 20px;
        font-weight: bold;

    }
    .nav button{
        background-color: transparent;
        color: var(--primaryText-color) !important;
        border: none;
    }
    .nav button:hover{
        background-color: var(--card-color);
        border: none;
    }

    .nav a {
        border: none;

    }

    a{
        text-decoration: none;
        transition: 0.3s;
        margin-right: 10px;
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

    a:hover {
        text-decoration: none;
        color: var(--hover-color);
    }

    .sidenav li {
        font-size: 20px;
        padding-left: 10px;
        list-style-type: none;
    }

    .sidenav ul {
        margin-top: 10px;
    }

    /* CSS DA BARRA DE BUSCA */
    #busca {
        margin-left: 15px;
        margin-bottom: -15px;
    }
</style>
<div id="mySidenav" class="sidebar-expanded d-none d-md-block sidenav">
    <div id="navbarContent">
        <div class="navbar-brand" style="font-family: 'Concert One', cursive; font-size: 50px; margin-left: 15px">Klass </div>
        @if(Auth::check())
            <form id="busca" class="navbar-form" role="search" action="{{route('search.Buscar')}}">
                <div class=" bg-light rounded shadow-sm">
                    <div class="input-group">
                        <input type="text" name="query" placeholder="Ache amigos..." aria-describedby="button-addon1"
                               class="form-control border-0 bg-light">
                        <div class="input-group-append">
                            <button class="btn btn-light" style="border-radius: 2px" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <br>
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{route('home')}}"><button style="border-radius: 25px; margin-bottom: 5px" class="btn"><i style="margin: 5px;" class="fa fa-home"></i> Página Inicial</button></a>
                </li>
                <li>
                    @if ( !$friendRequests->count())
                        <a href="{{route('friends.Solicitações')}}"><button style="border-radius: 25px; margin-bottom: 5px" class="btn"><i style="margin: 5px" class="fas fa-users"></i> Solicitações</button></a>
                    @else
                        <span>{{$friendRequests->count()}}</span><a href="{{route('friends.Solicitações')}}"><button style="border-radius: 25px; margin-bottom: 5px" class="btn"><i style="margin: 5px" class="fas fa-users"></i>Solicitações</button></a>
                    @endif
                </li>
                <li>
                    <a href="#"><button style="border-radius: 25px; margin-bottom: 5px" class="btn"><i style="margin: 5px" class="fas fa-bullhorn"></i> Notificações</button></a>
                </li>
                @endif
                @if (Auth::check())
                    <li>
                        <a href="{{route('profile.Perfil', ['username'=>Auth::user()->username])}}"><button style="border-radius: 25px; margin-bottom: 5px" class="btn"><i style="margin:5px 15px 5px 5px" class="fas fa-user"></i>Perfil</button></a></li>
                    <li>
                        <a href="{{route('config.Config')}}"><button style="border-radius: 25px" class="btn"><i style="margin: 5px" class="fas fa-cogs"></i> Configurações</button></a>
                    </li>
                    <div class="dropdown-divider"></div>
                    <li>
                        <a href="#" onclick="topFunction()" title="voltar ao topo"><button style="border-radius: 25px; margin-bottom: 5px" class="btn"><i style="margin: 5px" class="fas fa-arrow-up"></i> Voltar ao Topo</button></a>
                    </li>
                    <li>
                        <a href="{{route('auth.signout')}}"><button style="border-radius: 25px; margin-bottom: 5px" class="btn"><i style="margin: 5px" class="fas fa-sign-out-alt"></i> Sair</button></a>
                    </li>
                @else
                    <li>
                        <a href="{{route('auth.Login')}}"><button style="color: var(--primaryText-color) !important; border-radius: 25px; margin-bottom: 5px" class="btn"><i style="margin: 5px" class="fas fa-sign-in-alt"></i> Logar</button></a>
                    </li>
                    <li>
                        <a href="{{route('auth.SignUp')}}"><button style="color: var(--primaryText-color) !important; border-radius: 25px; margin-bottom: 5px" class="btn"><i style="margin: 5px" class="fas fa-id-badge"></i> Criar Conta</button></a>
                    </li>
                @endif
            </ul>
    </div>
</div>
<script>
    //function voltar ao topo
    mybutton = document.getElementById("topo");
    window.onscroll = function () {
        scrollFunction()
    };

    //se ele descer mostrar botão
    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    //volta ao topo quando clicado
    function topFunction() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    }
</script>
