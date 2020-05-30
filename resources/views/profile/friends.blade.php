@extends('templates.default')
@section('conteudo')
    <style>
        body {
            background-color: #212121;
            color: whitesmoke;
            margin: 0;
        }

        #conteudoPerfil {
            padding: 10px;
        }
        .list{
            background-color: #004d40;
            padding: 10px;
            border: white 1px solid;
            border-radius: 5px;
        }
    </style>
    <div id="conteudoPerfil" class="row">
        <div class="col-lg-5">
            <!-- INFORMAÇÕES DO USUARIO -->
            @include('user.partials.userblock')
            <hr>
            @if ( Auth::user()->hasFriendRequestPending($user) )
                <p>Aguardando {{ $user->getName() }} aceitar seu pedido</p>
            @elseif ( Auth::user()->hasFriendRequestReceived($user) )
                <a href="{{ route('friends.accept', ['email' => $user->email]) }}" class="btn btn-primary">Aceitar
                    pedido de amizade</a>
            @elseif ( Auth::user()->isFriendsWith($user) )
                <p>Você e {{ $user->getName() }} são amigos</p>
            @elseif ( Auth::user()->id !== $user->id)
                <a href="{{ route('friends.add', ['email' => $user->email]) }}" class="btn btn-primary">Adicionar
                    amigo</a>
            @endif
        </div>
    </div>
    <div class="list">
        <a href="{{url()->previous()}}"><i class="fas fa-arrow-left"></i> Voltar</a>
        <h4>Amigos</h4>
        <hr>
        @if(!$user->friends()->count())
            <p>Ainda não adicionou ninguém!</p>
            @else
            <div class="container-fluid row" style="width: fit-content">
            @foreach($user->friends() as $user)
                @include('user/partials/friendslist')
            @endforeach
            </div>
            @endif
    </div>
@stop

