<script src="https://kit.fontawesome.com/982d993f59.js" crossorigin="anonymous"></script>
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
    .nav button{
        background-color: var(--card-color);
    }
    .nav button a{
        color: var(--primaryText-color) !important;
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
                    <button style="border-radius: 25px; margin-bottom: 5px" class="btn"><a href="{{route('home')}}"><i style="margin: 5px;" class="fa fa-home"></i> Página Inicial</a></button>
                </li>
                <li>
                    <button style="border-radius: 25px; margin-bottom: 5px" class="btn"><a href="{{route('friends.Solicitações')}}"><i style="margin: 5px" class="fas fa-users"></i> Solicitações</a></button>
                </li>
                <li>
                    <button style="border-radius: 25px; margin-bottom: 5px" class="btn"><a href="#"><i style="margin: 5px" class="fas fa-bullhorn"></i> Notificações</a></button>
                </li>
                @endif
                @if (Auth::check())
                    <li>
                        <button style="border-radius: 25px; margin-bottom: 5px" class="btn"><a href="{{route('profile.Perfil', ['username'=>Auth::user()->username])}}"><i style="margin: 5px" class="fas fa-user"></i> Perfil</a></li>
                    <li>
                        <button style="border-radius: 25px" class="btn"><a href="{{route('config.Config')}}"><i style="margin: 5px" class="fas fa-cogs"></i> Configurações</a></button>
                    </li>
                    <div class="dropdown-divider"></div>
                    <li>
                        <button style="border-radius: 25px; margin-bottom: 5px" class="btn"><a href="#" onclick="topFunction()" title="voltar ao topo"><i style="margin: 5px" class="fas fa-arrow-up"></i> Voltar ao Topo</a></button>
                    </li>
                    <li>
                        <button style="border-radius: 25px; margin-bottom: 5px" class="btn"><a href="{{route('auth.signout')}}"><i style="margin: 5px" class="fas fa-sign-out-alt"></i> Sair</a></button>
                    </li>
                @else
                    <li>
                        <button style="border-radius: 25px; margin-bottom: 5px" class="btn"><a href="{{route('auth.Login')}}"><i style="margin: 5px" class="fas fa-sign-in-alt"></i> Logar</a></button>
                    </li>
                    <li>
                        <button style="border-radius: 25px; margin-bottom: 5px" class="btn"><a href="{{route('auth.SignUp')}}"><i style="margin: 5px" class="fas fa-id-badge"></i> Criar Conta</a></button>
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
