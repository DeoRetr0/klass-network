@extends('templates.default')
@section('pageTitle', 'Solicitações')
@section('conteudo')
<style>
        #allConteudo{
            margin-top: 30px;
        }
        #amigos{
            background-color: var(--bg-color);
            color: var(--font-color);
            padding: 10px;
            text-align: center;
            margin-left: 250px;
            border: white 2px solid;
            }
        #aceitar{
            margin-left: 120px;
        }
    </style>
        <div id="allConteudo">
            <h4>Pedidos de Amizade</h4>
            <div class="dropdown-divider"></div>
        <?php
            $friends = Auth::user()->friends();
            $friendRequests = Auth::user()->friendRequests();
            ?>
            @if ( !$friendRequests->count())
                <p>Você não tem pedidos pendentes.</p>
            @else
                @foreach ($friendRequests as $user)
                    <div class="pull-right" class="dropdown-item">
                    @include('user/partials/userblock')
                    </div>
                    <div class="dropdown-divider"></div>
                @endforeach
            @endif
        </div>
@stop
