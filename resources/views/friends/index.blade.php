@extends('templates.default')

@section('conteudo')
<style>
        #amigos{
            background-color: #212121;
            color: whitesmoke;
            padding: 10px;
            text-align: center;
            margin-left: 250px;
            border: white 2px solid;
            }
        #aceitar{
            margin-left: 120px;
        }
    </style>
        <div>
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
                        <a href="{{ route('friends.accept', ['email' => $user->email]) }}" id="aceitar" class="btn btn-primary">Aceitar</a>
                    </div>
                    <div class="dropdown-divider"></div>
                @endforeach
            @endif
        </div>
@stop
