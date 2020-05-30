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

        .card-header {
            color: #212121;
        }

        .itens {
            margin-top: 10px;
        }

        .card-body {
            color: #212121;
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
    <div id="perfilFundo" class="container">
        <div class="tab-content rounded" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-perfil" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="row">
                    <div class="itens col-sm-12 col-lg-4">
                        <!-- BIO / SOBRE -->
                        @if($user->getSobre() == '')
                        @else
                        <div class="card">
                                <div class="card-header">
                                    Sobre
                                </div>
                                <div class="card-body">
                                    <p>{{$user->getSobre()}}</p>
                                </div>
                            </div>
                        @endif
                    <!-- FIM DA BIO -->
                        <br>
                        <!-- INFOMAÇÕES PESSOAIS -->
                        <div class='card'>
                            <div class='card-header'>
                                Informações
                            </div>
                            <div class='card-body'>
                                @if($user->trabalho == '')
                                @else
                                    <p><i class="fas fa-briefcase fa-lg"></i> {{$user->trabalho}}</p>
                                @endif
                                @if($user->localizacao == '')
                                @else
                                    <p><i class="fas fa-home fa-lg"></i> {{$user->localizacao}}</p>
                                @endif
                                @if($user->nasceuEm == '')
                                @else
                                    <p><i class="fas fa-map-marker fa-lg"></i> {{$user->nasceuEm}}</p>
                                @endif
                                @if($user->relacionamento == '')
                                @else
                                    <p><i class="fas fa-heart fa-lg"></i></i> {{$user->relacionamento}}</p>
                                @endif
                                @if($user->dataNascimento == '')
                                @else
                                    <p><i class="fas fa-birthday-cake fa-lg"></i></i> {{$user->dataNascimento}}</p>
                                @endif
                            </div>
                        </div>
                        <!-- FIM DAS INFORMAÇÕES -->
                        <br>
                        <!-- AMIGOS -->
                        <div class='card'>
                            <div class='card-header'>
                                Amigos
                                <a href="{{route('profile.friends', ['email' =>$user->email])}}" style="float: right; color: black">Mostrar todos</a>
                            </div>
                            <div class='card-body'>
                                <p>@if(!$user->friends()->count())
                                    <p>Ainda não adicionou ninguém!</p>
                                    @else
                                        @foreach($user->friends() as $user)
                                            @include('user/partials/userbasic')
                                        @endforeach
                                    @endif
                                </p>
                            </div>
                        </div>
                        <!-- FIM DE AMIGOS -->
                        <br>
                        <!-- FOTOS -->
                        <div class='card'>
                            <div class='card-header'>
                                Fotos
                            </div>
                            <div class='card-body'>
                                <p>{{$user->localizacao}}</p>
                            </div>
                        </div>
                        <!-- FIM DE FOTOS -->
                    </div>
                    <!-- FAZER NOVA POSTAGEM -->
                    <div class='itens col-sm-12 col-lg-8 ' id='postagem'>
                        <div class='card'>
                            <div class='card-header'>
                                Fazer Postagem
                            </div>
                            <div class='card-body'>
                            <textarea name='post' id='post' rows='5'
                                      style="width: 100%" placeholder='  Quer dizer algo?'></textarea>
                            </div>
                            <div class='card-footer'>
                                <button type='button' class='btn btn-success'>Postar</button>
                            </div>
                        </div>
                        <!-- FIM DE FAZER NOVA POSTAGEM -->
                        <br>
                    <!-- POSTS FEITOS -->
                        <div class="card">
                            <div class='card-header'>
                                Posts feitos
                            </div>
                            <div class='card-body'>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto consequuntur
                                    dolore, dolores eius ipsam iure iusto laboriosam nam natus neque numquam obcaecati
                                    rem saepe sint sunt, temporibus veniam! Sapiente, tempora?</p>
                            </div>
                        </div>
                        <!-- FIM DE POSTS FEITOS -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop
