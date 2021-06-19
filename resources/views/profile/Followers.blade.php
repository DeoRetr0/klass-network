@extends('templates.default')
@section('pageTitle', 'Seguidores')
@section('conteudo')
<style>
body {
    background-color: var(--bg-color);
    color: var(--primaryText-color);
    margin: 0;
}

.list {
    padding: 10px;
    margin-left: -5px;
    margin-right: -5px;
    margin-top: -10px;
    border-radius: 5px;
    border: 1px solid var(--secondaryText-color);
    background-color: var(--card-color);
}

#head {
    width: available;
    margin-top: 30px;
    margin-right: -5px;
    margin-left: -5px;
    padding: 0;
}

#banner {
    padding: 5px;
    background-image: url("{{asset('uploads/banners/'.$user->getBanner())}}");
    background-repeat: no-repeat;
    border: 1px white solid;
    border-radius: 5px;
    background-size: cover;
}

.back {
    white-space: nowrap;
    text-decoration: none;
    color: whitesmoke;
}
</style>
<div id="head" class="container-fluid">
    <!-- INFORMAÇÕES DO USUARIO -->
    <div id="banner">
        @include('user.partials.userblock')
    </div>
    <hr>
    @if ( Auth::user()->hasFriendRequestPending($user) )
    @elseif ( Auth::user()->hasFriendRequestReceived($user) )
    <a href="{{ route('friends.accept', ['username' => $user->username]) }}" class="btn btn-primary">Aceitar
        seguidor</a>
    @elseif ( Auth::user()->isFriendsWith($user) )
    <p>Você segue {{ $user->getName() }}</p>
    @elseif ( Auth::user()->id !== $user->id)
    <a href="{{ route('friends.add', ['username' => $user->username]) }}" class="btn btn-primary">Seguir</a>
    @endif
</div>
<div class="list">
    &nbsp;<a class="back" href="{{url()->previous()}}"><i class="fas fa-arrow-left"></i> Voltar</a>&nbsp;
    <h4 style="display:inline">Seguidores</h4>
    <hr>
    @if(!$user->friends()->count())
    <p>Ainda não seguiu ninguém!</p>
    @else
    <div class="container-fluid row" style="width: fit-content">
        @foreach($user->friends() as $user)
        @include('user/partials/friendslist')
        @endforeach
    </div>
    @endif
</div>
@stop