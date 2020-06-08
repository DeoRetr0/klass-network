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

    /* CSS DO BOTÃO DE MUDAR TEMA */
    .theme-switch-wrapper {
        display: flex;
        align-items: center;

    em {
        margin-left: 10px;
        font-size: 1rem;
    }

    }
    .theme-switch {
        display: inline-block;
        height: 22px;
        position: relative;
        width: 50px;
    }

    .theme-switch input {
        display: none;
    }

    .slider {
        background-color: #ccc;
        bottom: 0;
        cursor: pointer;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
        transition: .4s;
    }

    .slider:before {
        background-color: #fff;
        bottom: 4px;
        content: "";
        height: 15px;
        left: 4px;
        position: absolute;
        transition: .4s;
        width: 15px;
    }

    em {
        color: white;
        font-style: normal;
        margin-bottom: 5px;
        margin-left: 5px;
    }

    input:checked + .slider {
        background-color: #66bb6a;
    }

    input:checked + .slider:before {
        transform: translateX(26px);
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 90%;
    }

</style>
<div id="mySidenav" class="sidebar-expanded d-none d-md-block sidenav">
    <div id="navbarContent">
        <div class="navbar-brand"></div>
        @if(Auth::check())
            <form id="busca" class="navbar-form" role="search" action="{{route('search.results')}}">
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
                <li><a href="{{route('friends.index')}}">Solicitações</a></li>
                <li style="margin-top: 3px"><a href="#">Notificações</a></li>
                @endif
                @if (Auth::check())
                    <li><a href="{{route('profile.index', ['email'=>Auth::user()->email])}}">Perfil</a></li>
                    <li><a href="#">Configurações</a></li>
                    <div class="dropdown-divider"></div>
                    <li><a href="#" onclick="topFunction()" title="voltar ao topo">Voltar ao Topo</a></li>
                    <li><a href="{{route('auth.signout')}}">Sair</a></li>
                @else
                    <li><a href="{{route('auth.login')}}">Logar</a></li>
                    <li><a href="{{route('auth.signup')}}">Criar Conta</a></li>
                @endif
                <li>
                    <div class="theme-switch-wrapper">
                        <label class="theme-switch" for="checkbox">
                            <input type="checkbox" id="checkbox"/>
                            <div class="slider round"></div>
                        </label>
                        <em>Modo Escuro</em>
                    </div>
                </li>
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

    //function mudar tema
    const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');

    function switchTheme(e) {
        if (e.target.checked) {
            document.documentElement.setAttribute('data-theme', 'dark');
        } else {
            document.documentElement.setAttribute('data-theme', 'light');
        }
    }

    toggleSwitch.addEventListener('change', switchTheme, false);

    function switchTheme(e) {
        if (e.target.checked) {
            document.documentElement.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
        } else {
            document.documentElement.setAttribute('data-theme', 'light');
            localStorage.setItem('theme', 'light');
        }
    }

    const currentTheme = localStorage.getItem('theme') ? localStorage.getItem('theme') : null;

    if (currentTheme) {
        document.documentElement.setAttribute('data-theme', currentTheme);

        if (currentTheme === 'dark') {
            toggleSwitch.checked = true;
        }
    }
</script>
