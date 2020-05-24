@extends('templates.default')

@section('conteudo')
    <style>
        body{
            background-color: #212121;
            color: whitesmoke;
        }
        #conteudoPerfil{
            padding: 10px;
        }
    </style>
<div id="conteudoPerfil" class="row">
    <div class="col-lg-5">
        <!-- INFORMAÇÕES DO USUARIO -->
        @include('user.partials.userblock')
        <hr>
    </div>
    <div class="col-lg-4 col-lg-offset-3">
        <h4>Amigos</h4>
        @if(!$user->friends()->count())
            <p>Ainda não adicionou ninguém!</p>
        @else
            @foreach($user->friends() as $user)
                @include('user/partials/userblock')
            @endforeach
        @endif
    </div>
</div>
@stop
