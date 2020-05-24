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
    <a class="navbar-brand" href="{{route('home')}}">The Social Network</a>
    <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
     @if(Auth::check())
        <ul class="nav navbar-nav">
            <li><a href="#">Home</a></li>
            <li><a href="#">Amigos</a></li>
        </ul>
        <form class="navbar-form navbar-left" role="search" action="{{route('search.results')}}">
            <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="Ache amigos...">
                <span class="input-group-btn">
                    <button class="btn btn-light" style="border-radius: 2px" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
    @endif
         <ul class="nav dropdown navbar-nav ml-auto">
             @if (Auth::check())
                 <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton"
                         data-toggle="dropdown" aria-haspopup="true" style="color: white"
                         aria-expanded="false">{{Auth::user()->getName()  }}  </button>
                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                     <li><a class="dropdown-item" href="{{route('profile.index', ['email'=>Auth::user()->email])}}">Ver Perfil</a></li>
                     <li><a class="dropdown-item" href="{{route('profile.edit')}}">Editar Perfil</a></li>
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
