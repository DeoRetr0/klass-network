@extends('templates.default')

@section('conteudo')
    <style>
        body {
            background-color: #212121;
            color: whitesmoke;
            margin: 0;
            padding: 0;
        }
        #perfilFundo{
            margin: 0;
            padding: 0;
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

        #banner {
            background-image: url("https://seeoutlook.com/wp-content/uploads/2018/09/FB-COVER.jpg");
            background-repeat: no-repeat;
            background-size: cover;
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

        #conteudo {
            margin-top: 20px;
        }

        ul#opcoes li {
            display: inline;
            margin: 0;
        }

        .card a {
            color: #212121;
        }
    </style>
    <div id="perfilFundo" class="container">
        <div class="col" style="padding: 0">
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
                    <a href="{{ route('friends.add', ['email' => $user->email]) }}" class="btn btn-success"
                       style="margin-bottom: 10px">
                        Adicionar amigo
                    </a>
                @endif
            </div>
        </div>
        <div class="tab-content rounded" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-perfil" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="row">
                    <div class="itens col-sm-12 col-lg-4">
                        <!-- INFOMAÇÕES PESSOAIS -->
                        <div class='card'>
                            <div class='card-header' style="line-height: 35px">
                                <i class="far fa-address-card"></i> Informações
                                @if($user == Auth::user())
                                    <button type="button"
                                            style="float: right;width: fit-content; color: black;padding: 5px"
                                            class="btn btn-light" data-toggle="modal" data-target="#exampleModal">
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
                                        <div class="modal-content" style="background-color: #004d40">
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
                        <br>
                        <!-- AMIGOS -->
                        <div class='card'>
                            <div class='card-header'>
                                <i class="fas fa-user-friends"></i> Amigos
                                <a href="{{route('profile.friends', ['email' =>$user->email])}}"
                                   style="float: right; color: black">Mostrar todos</a>
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
                    <div class='itens col-sm-12 col-lg' id='postagem'>
                        @if(Auth::user()->id != $user->id)
                        <form role="form" action="{{route('status.post')}}" method="post">
                            <div class='card'>
                                <div class='card-body'>
                        <textarea required class="form-control" name='status' id='post' rows='2'
                                  style="width: 100%" placeholder='  Quer dizer algo?'></textarea>
                                </div>
                                <div class='card-footer'>
                                    <button type='submit' class='btn btn-success'>Postar</button>
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                        </form>
                        <!-- FIM DE FAZER NOVA POSTAGEM -->
                        <br>
                        @endif
                    <!-- POSTS FEITOS -->
                        @if(!$status->count())
                            <p>{{$user->getName()}} ainda não postou.</p>
                        @else
                        @foreach($status as $post)
                                <div class="col-sm-12 col-lg" style="padding: 0">
                                    <div class="card">
                                        <div class='card-body'>
                                            <div class="media" style="margin-top: 0">
                                                <a class="pull-left"
                                                   href="{{route('profile.index', ['email'=>$post->user->email]) }}">
                                                    <img style="border-radius: 50px" class="media-object" alt="{{$post->user->getName()}}"
                                                         src="{{ $post->user->getAvatarUrlBasic()}}">
                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading"><a
                                                            href="{{route('profile.index', ['email'=>$post->user->email]) }}">{{$post->user->getName()}}</a>
                                                    </h4>
                                                    <ul class="list-inline">
                                                        <span hidden>{{\Carbon\Carbon::setLocale('pt_BR')}}</span>
                                                        <li>{{$post->created_at->diffForHumans()}}</li>
                                                    </ul>
                                                    <hr>
                                                    <p>{{$post->body}}</p>
                                                    <ul class="list-inline" id="opcoes">
                                                        <li>{{$post->likes->count()}} {{Str::plural('curtidas', $post->likes->count())}}</li>
                                                    </ul>
                                                    {{--RESPOSTA DO STATUS --}}
                                                    @foreach($post->replies as $reply)
                                                        <div class="media" style="margin-top: 5px">
                                                            <a class="pull-left"
                                                               href="{{route('profile.index', ['email' => $reply->user->email])}}">
                                                                <img style="border-radius: 50px" class="media-object"
                                                                     alt="{{$reply->user->getName()}}"
                                                                     src="{{$reply->user->getAvatarUrlBasic()}}">
                                                            </a>
                                                            <div class="media-body">
                                                                <h6>
                                                                    <a href="{{route('profile.index', ['email' => $reply->user->email])}}">{{$reply->user->getName()}}</a>
                                                                </h6>
                                                                <p>{{$reply->body}}</p>
                                                                <ul class="list-inline" id="opcoes">
                                                                    <span
                                                                        hidden>{{\Carbon\Carbon::setLocale('pt_BR')}}</span>
                                                                    <li>{{$reply->created_at->diffForHumans()}}</li>
                                                                @if($reply->user->id !== Auth::user()->id)
                                                                        <li><a href="{{route('status.like', ['statusId'=>$reply->id])}}">Like</a></li>
                                                                    @endif
                                                                    <li>{{$reply->likes->count()}} {{Str::plural('curtidas', $reply->likes->count())}}</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @if($authUserIsFriend || Auth::user()->id===$post->user->id)
                                                        <form role="form"
                                                              action="{{route('status.reply', ['statusId' => $post->id])}}"
                                                              method="post">
                                                            <div
                                                                class="form-group {{$errors->has("reply-{$post->id}") ? 'has-error':''}}">
                                                            <textarea name="reply-{{$post->id}}" class="form-control"
                                                                      rows="2" placeholder="Comente sobre"></textarea>
                                                                @if($errors->has("reply-{$post->id}"))
                                                                    <span class="help-block">
                                                        {{$errors->first("reply-{$post->id}")}}
                                                    </span>
                                                                @endif
                                                            </div>
                                                            <input type="submit" value="Comentar"
                                                                   class="btn btn-default btn-sm">
                                                            <input type="hidden" name="_token"
                                                                   value="{{Session::token()}}">
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                        @endforeach
                    @endif
                    <!-- FIM DE POSTS FEITOS -->
                    </div>
                    <br>
                </div>
                <br>
            </div>
        </div>
    </div>
    </div>
@stop
