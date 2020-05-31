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
        #banner{
            background-image: url("https://seeoutlook.com/wp-content/uploads/2018/09/FB-COVER.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            border: 1px white solid;
            display: block;
        }
        #mudarBanner{
            float: right;
            padding-top: 10px;
        }
        .media{
            width: 100%;
            margin-top: 200px;
            margin-bottom: 20px;
        }
    </style>
    <div id="conteudoPerfil" class="row">
        <div class="col">
            <!-- INFORMAÇÕES DO USUARIO -->
            <div class="container-fluid" id="banner">
                @if($user == Auth::user())
                    <div id="mudarBanner">
                        <button type="submit" class="btn btn-light">Mudar banner</button>
                    </div>
                @endif
            @include('user.partials.userblock')
                    @if ( Auth::user()->hasFriendRequestPending($user) )
                        <p>Aguardando {{ $user->getName() }} aceitar seu pedido</p>
                    @elseif ( Auth::user()->hasFriendRequestReceived($user) )
                        <a href="{{ route('friends.accept', ['email' => $user->email]) }}" class="btn btn-primary">Aceitar
                            pedido de amizade</a>
                    @elseif ( Auth::user()->isFriendsWith($user) )
                        <p>Você e {{ $user->getName() }} são amigos</p>
                    @elseif ( Auth::user()->id !== $user->id)
                        <a href="{{ route('friends.add', ['email' => $user->email]) }}" class="btn btn-success" style="margin-bottom: 10px">
                            Adicionar amigo
                        </a>
                    @endif
            </div>
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
                                    <i class="fas fa-globe-americas"></i> Sobre
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
                            <div class='card-header' style="line-height: 35px">
                                <i class="far fa-address-card"></i> Informações
                                @if($user == Auth::user())
                                    <button type="button" style="float: right;width: fit-content; color: black;padding: 5px" class="btn btn-light" data-toggle="modal" data-target="#exampleModal">
                                        Editar
                                    </button>
                                @endif
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
                                        @php
                                            $original_date = "$user->dataNascimento";
                                            $timestamp = strtotime($original_date);
                                            $new_date = date("d/m/Y", $timestamp);
                                                    echo '<p><i class="fas fa-birthday-cake fa-lg"></i></i> '.$new_date.'</p>'
                                        @endphp
                                @endif
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content" style="background-color: #004d40">
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
                        <!-- FIM DAS INFORMAÇÕES -->
                        <br>
                        <!-- AMIGOS -->
                        <div class='card'>
                            <div class='card-header'>
                                <i class="fas fa-user-friends"></i> Amigos
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
