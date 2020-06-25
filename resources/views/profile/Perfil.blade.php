@extends('templates.default')
@section('conteudo')
    <style>
        @media only screen and (max-width: 725px) {
        .conteudoCarregado{
            padding-left: 0px;
            left: 3%;
        }
        }
        /* CSS DA PARTE DE CIMA - IMAGEM E BANNER*/
        #head {
            width: available;
            margin-top: 30px;
            padding: 0;
        }

        #banner {
            padding: 5px;
            background-image: url("https://seeoutlook.com/wp-content/uploads/2018/09/FB-COVER.jpg");
            background-repeat: no-repeat;
            border: 1px white solid;
        }

        #mudarBanner {
            float: right;
            padding-top: 10px;
        }

        .media {
            margin-top: 200px;
            margin-bottom: 20px;
        }

        #desAmigo {
            margin-bottom: 10px;
        }

        /* CSS DOS STATUS/CARDS CARREGADOS*/
        .status a {
            color: var(--primaryText-color);
        }

        .status {
            margin-bottom: 5px;
            padding: 0;
            border: 1px solid var(--secondaryText-color);
            border-radius: 4px;
            background-color: var(--card-color);
        }

        .textarea, .textarea::placeholder, .textarea:focus {
            background: var(--card-color);
            border: none;
            color: var(--primaryText-color);
        }

        ul#opcoes li {
            display: inline;
            margin: 0;
        }

        div.card {
            margin-bottom: 10px;
        }

        /* CSS DOS BOTÕES QUE FICAM DENTRO DOS CARDS*/
        .headerButtons {
            float: right;
        }

        /* CSS DE TODOS OS BOTÕES*/
        .btn {
            background-color: var(--secondary-color);
            border: solid 1px var(--font-color);
        }

        .btn:hover, .btn:active {
            background-color: var(--primary-color);
            border: solid 1px var(--font-color);
        }
    </style>
    <div id="head" class="container-fluid">
        <!-- INFORMAÇÕES DO USUARIO -->
        <div id="banner">
            @if($user == Auth::user())
                <div id="mudarBanner">
                    <button type="submit" class="btn">Mudar banner</button>
                </div>
            <div class="container" style="background-color: #3b404f; width: fit-content; margin: 0;">
                <form enctype="multipart/form-data" method="post" action="/mudarImagem" style="padding: 5px">
                    <label>Mudar Imagem de Perfil</label><br>
                    <input type="file" name="avatar"><br>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="submit" class="btn-sm btn-primary" style="margin-top: 5px">
                </form>
            </div>
            @endif
            @include('user.partials.userblock')
            @if ( Auth::user()->hasFriendRequestPending($user) )
                <p>Aguardando {{ $user->getName() }} aceitar seu pedido</p>
            @elseif ( Auth::user()->hasFriendRequestReceived($user) )
                <a href="{{ route('friends.accept', ['username' => $user->username]) }}" class="btn btn-success">Aceitar
                    pedido de amizade</a>
            @elseif ( Auth::user()->isFriendsWith($user) )
                <p>Você e {{ $user->getName() }} são amigos</p>
                <form action="{{route('friends.delete', ['username' => $user->username])}}" method="post">
                    <input id="desAmigo" type="submit" class="btn btn-danger btn-sm" value="Desfazer amizade">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                </form>
            @elseif ( Auth::user()->id !== $user->id)
                <a href="{{ route('friends.add', ['username' => $user->username]) }}" class="btn btn-success"
                   style="margin-bottom: 10px">
                    Adicionar amigo
                </a>
            @endif
        </div>
    </div>
    <br>
    <div class="tab-content rounded">
        <div class="tab-pane fade show active" id="nav-perfil" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="row">
                <div class="itens col-lg-4 col-sm-12">
                    <!-- INFOMAÇÕES PESSOAIS -->
                    <div class='status card'>
                        <div class='card-header' style="line-height: 35px">
                            <i class="far fa-address-card"></i> Info
                            @if($user == Auth::user())
                                <button type="button"
                                        class="headerButtons btn" data-toggle="modal" data-target="#exampleModal">
                                    Editar
                                </button>
                            @endif
                        </div>
                        <div class='card-body'>
                            @if($user->getSobre() == '')
                            @else
                                <p>{{$user->getSobre()}}</p>
                                <hr>
                            @endif
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
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="background-color: var(--primary-color)">
                                        <div class="modal-body">
                                            <button type="button" class="close btn" data-dismiss="modal"
                                                    aria-label="Close">
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
                    <!-- AMIGOS -->
                    <div class='status card'>
                        <div class='card-header'>
                            <i class="fas fa-user-friends"></i> Amigos
                            <a class="headerButtons" href="{{route('profile.friends', ['username' =>$user->username])}}">Todos</a>
                        </div>
                        <div class='card-body' style="margin-left: 20px">
                            <p>@if(!$user->friends()->count())
                                <p>Ainda não adicionou ninguém!</p>
                                @else
                                    @foreach($user->friends()->take(4) as $user)
                                            @include('user/partials/userbasic')
                                @endforeach
                                @endif
                                </p>
                        </div>
                    </div>
                    <!-- FIM DE AMIGOS -->
                    <!-- FOTOS -->
                    <div class='status card'>
                        <div class='card-header'>
                            Fotos
                        </div>
                        <div class='card-body'>
                            <p>FOTOS</p>
                        </div>
                    </div>
                    <!-- FIM DE FOTOS -->
                </div>
                <!-- POSTS FEITOS -->
                <div class='itens col-lg-8 col-sm-12' id='postagem'>
                    @if(!$status->count())
                        <p>Sem postagens!</p>
                    @else
                        @foreach($status as $post)
                            <div id="post" class="status card">
                                <div class='card-body'>
                                    <div class="media" style="margin-top: 0">
                                        <a class="pull-left"
                                           href="{{route('profile.Perfil', ['username'=>$post->user->username]) }}">
                                            <img style="border-radius: 50px; width: 60px" class="media-object"
                                                 alt="{{$post->user->getName()}}"
                                                 src="{{URL::asset("uploads/avatars/{$post->user->avatar}")}}">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading"><a
                                                    href="{{route('profile.Perfil', ['username'=>$post->user->username]) }}">{{$post->user->getName()}}</a>
                                            </h4>
                                            <ul class="list-inline">
                                                <span hidden>{{\Carbon\Carbon::setLocale('pt_BR')}}</span>
                                                <li>{{$post->created_at->diffForHumans()}}</li>
                                            </ul>
                                            <hr>
                                            <p>{{$post->body}}</p>
                                            <ul class="list-inline" id="opcoes">
                                                @if($post->user->id !== Auth::user()->id)
                                                    <li>
                                                        <a href="{{route('status.like', ['statusId'=>$post->id])}}">
                                                            <i class="fas fa-heart"></i> Curtir</a>
                                                    </li>
                                                @endif
                                                <li>{{$post->likes->count()}} {{Str::plural('curtidas', $post->likes->count())}}</li>
                                            </ul>
                                            {{--RESPOSTAS DO STATUS --}}
                                            @if($post->replies->count()>0)
                                                <button class="btn btn-sm" style="margin-bottom: 10px" type="button"
                                                        data-toggle="collapse" data-target=".collapse"
                                                        aria-expanded="false" aria-controls="collapseExample">
                                                    Ver Comentários
                                                </button>
                                            @endif
                                            @foreach($post->replies as $reply)
                                                <div class="collapse media" style="margin-top: 5px">
                                                    <a class="pull-left"
                                                       href="{{route('profile.Perfil', ['username' => $reply->user->username])}}">
                                                        <img style="border-radius: 50px; width: 60px" class="media-object"
                                                             alt="{{$reply->user->getName()}}"
                                                             src="{{URL::asset("uploads/avatars/{$reply->user->avatar}")}}">
                                                    </a>
                                                    <div class="media-body">
                                                        <h6>
                                                            <a href="{{route('profile.Perfil', ['username' => $reply->user->username])}}">{{$reply->user->getName()}}</a>
                                                        </h6>
                                                        <p>{{$reply->body}}</p>
                                                        <ul class="list-inline" id="opcoes">
                                                                    <span
                                                                        hidden>{{\Carbon\Carbon::setLocale('pt_BR')}}</span>
                                                            <li>{{$reply->created_at->diffForHumans()}}</li>
                                                            @if($reply->user->id !== Auth::user()->id)
                                                                @if($reply->user->id !== Auth::user()->id)
                                                                    <li>
                                                                        <a href="{{route('status.like', ['statusId'=>$reply->id])}}"><i
                                                                                class="fas fa-heart"></i> Curtir</a>
                                                                    </li>
                                                                @endif
                                                            @endif
                                                            <li>{{$reply->likes->count()}} {{Str::plural('curtidas', $reply->likes->count())}}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endforeach
                                        <!-- CRIAR COMENTÁRIO SE SÃO AMIGOS OU SE É MEU POST -->
                                            @if($authUserIsFriend || Auth::user()->id===$post->user->id)
                                                <form role="form"
                                                      action="{{route('status.reply', ['statusId' => $post->id])}}"
                                                      method="post">
                                                    <div
                                                        class="form-group {{$errors->has("reply-{$post->id}") ? 'has-error':''}}">
                                                            <textarea name="reply-{{$post->id}}"
                                                                      class="textarea form-control"
                                                                      rows="2"
                                                                      placeholder="Comente sobre..."></textarea>
                                                        @if($errors->has("reply-{$post->id}"))
                                                            <span class="help-block">
                                                        {{$errors->first("reply-{$post->id}")}}
                                                    </span>
                                                        @endif
                                                    </div>
                                                    <input type="submit" value="Comentar"
                                                           class="btn btn-sm">
                                                    <input type="hidden" name="_token"
                                                           value="{{Session::token()}}">
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                @endif
                <!-- FIM DE POSTS FEITOS -->
                </div>
                <br>
            </div>
            <br>
        </div>
    </div>
@stop
