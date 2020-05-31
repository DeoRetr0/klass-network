 <style>
      /* MENU */
        .navbar {
            background-color: #004d40;
            font-family: 'Righteous', cursive;
            font-size: 20px;
        }
        a {
            text-decoration: none;
            color: whitesmoke;
            margin-right: 10px;
        }
        a:hover {
            text-decoration: none;
            color: lightgrey;
        }
    </style>
<!-- Inicio da Barra de Navegação
 ** MENU DESKTOP ** -->
<nav class="navbar navbar-expand-lg">
    <i class="fas fa-atom fa-lg" style="margin: 10px"></i>
    <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
        <ul class="nav navbar-nav">
            <li style="margin-top: 3px; margin-left: 10px"><a href="{{route('home')}}"><i class="fas fa-home fa-lg"></i></a></li>
            <button style="margin-right: 10px" class="btn btn-default" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-friends fa-lg" style="color:whitesmoke"></i>
            </button>
            <div id="amigos" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @include('friends/index')
            </div>
            <li style="margin-top: 3px"><a href="#"><i class="fas fa-bell fa-lg"></i></a></li>
        </ul>
    @endif
         <ul class="nav dropdown navbar-nav ml-auto">
             @if (Auth::check())
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton"
                         data-toggle="dropdown" aria-haspopup="true" style="color: white"
                         aria-expanded="false">{{Auth::user()->getName()  }}  </button>
                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                     <li><a class="dropdown-item" href="{{route('profile.index', ['email'=>Auth::user()->email])}}">Ver Perfil</a></li>
                     <li><a class="dropdown-item" href="#">Configurações</a></li>
                     <div class="dropdown-divider"></div>
                     <li><a class="dropdown-item" href="{{route('auth.signout')}}">Sair</a></li>
                 </div>
             @else
                 <li><a href="{{route('auth.login')}}">Logar</a></li>
                 <li><a href="{{route('auth.signup')}}">Criar Conta</a></li>
             @endif
         </ul>
    </div>
</nav>
