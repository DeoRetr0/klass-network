@extends('templates.default')
@section('pageTitle', 'Configurações')
@section('conteudo')
<style>
#home {
    margin-top: 50px;
    width: available;
    padding: 0;
}

.card {
    margin-bottom: 5px;
    padding: 0;
    border: 1px solid var(--secondaryText-color);
    border-radius: 4px;
    background-color: var(--card-color);
}

h3 {
    color: var(--primaryText-color);
}

.nowrap {
            white-space: nowrap;
        }

/* CSS DO BOTÃO DE MUDAR TEMA */
.theme-switch-wrapper {
    display: flex;
    align-items: center;
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

input:checked+.slider {
    background-color: #66bb6a;
}

input:checked+.slider:before {
    transform: translateX(26px);
}

.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 90%;
}
</style>
<div id="home" class="container-fluid">
    <div class='status card'>
        <div class='card-header'>
            <h3>Configurações Gerais</h3>
        </div>
        <div class='card-body' style="margin-left: 20px">
            <div class="theme-switch-wrapper">
                <label class="theme-switch" for="checkbox">
                    <input type="checkbox" id="checkbox" />
                    <div class="slider round"></div>
                </label>
                <em style="color: var(--primaryText-color)">Modo Escuro</em>
            </div>
        </div>
    </div>
    <div class='status card'>
        <div class='card-header'>
            <h3 class="nowrap" style="display:inline">Informações Pessoais </h3>&nbsp;
            <button style="display:inline" type="button" class="headerButtons btn pull-right btn-light" data-toggle="modal" data-target="#alterarDados">
                Editar
            </button>
        </div>
        <div class='card-body'>
            @if(Auth::user()->getSobre() == '')
            @else
            <p>{{Auth::user()->getSobre()}}</p>
            <hr>
            @endif
            @if(Auth::user()->trabalho == '')
            @else
            <p><i class="fas fa-briefcase fa-lg"></i> {{Auth::user()->trabalho}}</p>
            @endif
            @if(Auth::user()->localizacao == '')
            @else
            <p><i class="fas fa-home fa-lg"></i> {{Auth::user()->localizacao}}</p>
            @endif
            @if(Auth::user()->data_nascimento == '')
            @else
            <p><i class="fas fa-map-marker fa-lg"></i> {{Auth::user()->data_nascimento}}</p>
            @endif
            @if(Auth::user()->relacionamento == '')
            @else
            <p><i class="fas fa-heart fa-lg"></i></i> {{Auth::user()->relacionamento}}</p>
            @endif
            @if(Auth::user()->dataNascimento == '')
            @else
            @php
            $original_date = "Auth::user()->dataNascimento";
            $timestamp = strtotime($original_date);
            $new_date = date("d/m/Y", $timestamp);
            echo '<p><i class="fas fa-birthday-cake fa-lg"></i></i> '.$new_date.'</p>'
            @endphp
            @endif
            <div class="modal fade" id="alterarDados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="background-color: var(--primary-color)">
                        <div class="modal-body">
                            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            @include('profile.edit')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
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

    if (currentTheme) {
        document.documentElement.setAttribute('data-theme', currentTheme);

        if (currentTheme === 'dark') {
            toggleSwitch.checked = true;
        }
    }
</script>
@stop