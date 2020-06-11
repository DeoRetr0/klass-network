<style>
    /* CSS DA BARRA LATERAL */
    .sidenav {
        background-color: var(--primary-color);
        position: fixed;
        height: 100%;
        padding: 20px;
        margin-top: 0;
        border-right: solid 1px var(--font-color);
    }

    #navbarContent {
        font-size: 20px;
        font-weight: bold;

    }

    a {
        text-decoration: none;
        transition: 0.3s;
        color: var(--font-color);
        margin-right: 10px;
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
        <div class="navbar-brand" style="font-family: 'Concert One', cursive; font-size: 50px; margin-left: 15px">Klass</div>
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
                <li><a href="{{route('home')}}">Página Inicial</a></li>
                <li><a href="{{route('friends.Solicitações')}}">Solicitações</a></li>
                <li style="margin-top: 3px"><a href="#">Notificações</a></li>
                @endif
                @if (Auth::check())
                    <li><a href="{{route('profile.Perfil', ['username'=>Auth::user()->username])}}">Perfil</a></li>
                    <li><a href="{{route('config.Config')}}">Configurações</a></li>
                    <div class="dropdown-divider"></div>
                    <li><a href="#" onclick="topFunction()" title="voltar ao topo">Voltar ao Topo</a></li>
                    <li><a href="{{route('auth.signout')}}">Sair</a></li>
                @else
                    <li><a href="{{route('auth.login')}}">Logar</a></li>
                    <li><a href="{{route('auth.signup')}}">Criar Conta</a></li>
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
