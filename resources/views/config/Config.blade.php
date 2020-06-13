@extends('templates.default')

@section('conteudo')
    <style>
        #home{
            margin-top: 50px;
        }
        .card {
            margin-bottom: 5px;
            padding: 0;
            border: 1px solid var(--secondaryText-color);
            border-radius: 4px;
            background-color: var(--card-color);
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
    <div id="home">
        <div class='status card'>
            <div class='card-header'>
                <h3>Configurações Gerais</h3>
            </div>
            <div class='card-body' style="margin-left: 20px">
                <div class="theme-switch-wrapper">
                    <label class="theme-switch" for="checkbox">
                        <input type="checkbox" id="checkbox"/>
                        <div class="slider round"></div>
                    </label>
                    <em style="color: var(--primaryText-color)">Modo Escuro</em>
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
