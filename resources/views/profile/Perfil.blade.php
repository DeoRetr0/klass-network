@extends('templates.default')
@section('conteudo')
<style>
@media only screen and (max-width: 725px) {
    .conteudoCarregado {
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
    background-image: url("{{asset('uploads/banners/'.$user->getBanner())}}");
    background-repeat: no-repeat;
    border: 1px white solid;
    border-radius: 5px;
    background-size: cover;
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

.like {
    color: white;
}

.tab {
    margin: 15px;
    margin-top: -15px;
    padding: -50px;
}

.textarea,
.textarea::placeholder,
.textarea:focus {
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

.btn:hover,
.btn:active {
    background-color: var(--hover-color);
    border: solid 1px var(--font-color);
}
</style>
<div id="head" class="container-fluid">
    <!-- INFORMAÇÕES DO USUARIO -->
    <div id="banner">
        @include('user.partials.userblock')
    </div>
</div>
<br>
<div class="tab-content rounded">
    <div class="tab-pane fade show active" id="nav-perfil" role="tabpanel" aria-labelledby="nav-home-tab">
        <!-- Tabs de dados -->
        <div class="row">
            <!-- INFOMAÇÕES PESSOAIS -->
            <div class='status card tab col' style="margin-right: -10px">
                <div class='card-header'>
                    <i class="far fa-address-card"></i>
                    <a class="headerButtons" href="#">Ver Informações</a>
                </div>
            </div>
            <!-- FIM DAS INFORMAÇÕES -->
            <!-- AMIGOS -->
            <div class='status card tab col' style="margin-right: -10px">
                <div class='card-header'>
                    <i class="fas fa-user-friends"></i>
                    <a class="headerButtons" href="{{route('profile.Followers', ['username' =>$user->username])}}">Ver
                        Seguidores</a>
                </div>
            </div>
            <!-- FIM DE AMIGOS -->
            <!-- FOTOS -->
            <div class='status card tab col'>
                <div class='card-header'>
                    <i class="fas fa-photo-video"></i>
                    <a class="headerButtons" href="#">Ver Fotos/Vídeos</a>
                </div>
            </div>
            <!-- FIM DE FOTOS -->
        </div>
        <!-- FIM DE Tabs de dados -->
        <div class="row">
            <!-- POSTS FEITOS -->
            <div class='itens col' id='postagem'>
                @if(!$status->count())
                <p>Sem postagens!</p>
                @else
                @foreach($status as $post)
                <div id="post" class="status card">
                    <div class='card-body'>
                        <div class="media" style="margin-top: 0">
                            <div class="media-body">
                                @include('user.partials.userbasic')
                                <hr>
                                <p>{{$post->body}}</p>
                                <ul class="list-inline" id="opcoes">
                                    <span hidden>{{\Carbon\Carbon::setLocale('pt_BR')}}</span>
                                    <li>{{$post->created_at->diffForHumans()}} &nbsp;</li>
                                    <li class="likeCount-{{$post->id}}" value="{{$post->id}}">
                                        {{$post->likes_count}}
                                    </li> <i class="fas fa-heart"></i>
                                    @if($post->user->id !== Auth::user()->id)
                                    <br>
                                    <li>
                                        <button type="button" class="like btn btn-sm" value="{{$post->id}}">
                                            <i class="fas fa-heart"></i> Curtir
                                        </button>
                                    </li>
                                    @endif
                                </ul>
                                {{--RESPOSTAS DO STATUS --}}
                                @if($post->replies->count()>0)
                                <button class="btn btn-sm" style="margin-bottom: 10px" type="button"
                                    data-toggle="collapse" data-target=".collapse" aria-expanded="false"
                                    aria-controls="collapseExample">
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
                                            <a
                                                href="{{route('profile.Perfil', ['username' => $reply->user->username])}}">{{$reply->user->getName()}}</a>
                                        </h6>
                                        <p>{{$reply->body}}</p>
                                        <ul class="list-inline" id="opcoes">
                                            <span hidden>{{\Carbon\Carbon::setLocale('pt_BR')}}</span>
                                            <li>{{$reply->created_at->diffForHumans()}} &nbsp;</li>
                                            <li class="likeCount-{{$reply->id}}" value="{{$reply->id}}">
                                                {{$reply->likes->count()}}
                                            </li><i class="fas fa-heart"></i>
                                            <br>
                                            @if($reply->user->id !== Auth::user()->id)
                                            <button type="button" class="like btn btn-sm" value="{{$reply->id}}">
                                                <i class="fas fa-heart"></i> Curtir
                                            </button>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                                <!-- CRIAR COMENTÁRIO SE SÃO AMIGOS OU SE É MEU POST -->
                                @if($authUserIsFriend || Auth::user()->id===$post->user->id)
                                <form role="form" action="{{route('status.reply', ['statusId' => $post->id])}}"
                                    method="post">
                                    <div class="form-group {{$errors->has("reply-{$post->id}") ? 'has-error':''}}">
                                        <textarea name="reply-{{$post->id}}" class="textarea form-control" rows="2"
                                            placeholder="Comente sobre..."></textarea>
                                        @if($errors->has("reply-{$post->id}"))
                                        <span class="help-block">
                                            {{$errors->first("reply-{$post->id}")}}
                                        </span>
                                        @endif
                                    </div>
                                    <input type="submit" value="Comentar" class="btn btn-sm">
                                    <input type="hidden" name="_token" value="{{Session::token()}}">
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