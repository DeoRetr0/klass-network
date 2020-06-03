@extends('templates.default')

@section('conteudo')
    <style>
        body{
            background-color: #212121;
        }
        #conteudo{
            margin-top: 20px;
            padding-right: 10px;
        }
        ul#opcoes li {
            display:inline;
            margin: 0;
        }
        .card a{
            color: #212121;
        }
    </style>
    <!-- POSTAR STATUS -->
    <div id="conteudo" class="row">
        <div class="col-sm-12 col-lg-8" style="padding: 0; margin-left: 10px; margin-bottom: 10px">
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
        </div>
{{--        <div id="chatlist" style="background-color: grey; padding: 10px; margin: 10px" class="col-sm-12 col-lg">--}}
{{--            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum eius ex explicabo illum totam? Distinctio, error fugiat id illum inventore molestias, mollitia nam perferendis porro quam ratione recusandae saepe suscipit.</p>--}}
{{--            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum eius ex explicabo illum totam? Distinctio, error fugiat id illum inventore molestias, mollitia nam perferendis porro quam ratione recusandae saepe suscipit.</p>--}}
{{--            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum eius ex explicabo illum totam? Distinctio, error fugiat id illum inventore molestias, mollitia nam perferendis porro quam ratione recusandae saepe suscipit.</p>--}}
{{--            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum eius ex explicabo illum totam? Distinctio, error fugiat id illum inventore molestias, mollitia nam perferendis porro quam ratione recusandae saepe suscipit.</p>--}}
{{--        </div>--}}
    <!-- OUTROS STATUS -->
        @if(!$status->count())
            <p>Ainda não houve postagens.</p>
        @else
            @foreach($status as $post)
                @if(Auth::user()->isFriendsWith($post->user) || Auth::user()->id===$post->user->id)
                <div class="card col-sm-12 col-lg-8" style="margin-left: 10px;margin-bottom: 5px; padding: 0">
                    <div class='card-body'>
                        <div class="media">
                            <a class="pull-left" href="{{route('profile.index', ['email'=>$post->user->email]) }}">
                                <img style="border-radius: 50px"class="media-object" alt="{{$post->user->getName()}}"
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
                                    @if($post->user->id !== Auth::user()->id)
                                        <li><a href="{{route('status.like', ['statusId'=>$post->id])}}">Curtir</a></li>
                                    @endif
                                        <li>{{$post->likes->count()}} {{Str::plural('curtida', $post->likes->count())}}</li>
                                </ul>
                                {{--RESPOSTA DO STATUS --}}
                                @foreach($post->replies as $reply)
                                    <div class="media">
                                        <a class="pull-left"
                                           href="{{route('profile.index', ['email' => $reply->user->email])}}">
                                            <img class="media-object" style="border-radius: 50px" alt="{{$reply->user->getName()}}"
                                                 src="{{$reply->user->getAvatarUrlBasic()}}">
                                        </a>
                                        <div class="media-body">
                                            <h6>
                                                <a href="{{route('profile.index', ['email' => $reply->user->email])}}">{{$reply->user->getName()}}</a>
                                            </h6>
                                            <p>{{$reply->body}}</p>
                                            <ul class="list-inline" id="opcoes">
                                                <span hidden>{{\Carbon\Carbon::setLocale('pt_BR')}}</span>
                                                <li>{{$reply->created_at->diffForHumans()}}</li>
                                                @if($reply->user->id !== Auth::user()->id)
                                                <li><a href="{{route('status.like', ['statusId'=>$reply->id])}}">Curtir</a></li>
                                                @endif
                                                <li>{{$reply->likes->count()}} {{Str::plural('curtidas', $reply->likes->count())}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            @if(Auth::user()->isFriendsWith($post->user) || Auth::user()->id===$post->user->id)
                                    <form role="form" action="{{route('status.reply', ['statusId' => $post->id])}}"
                                          method="post">
                                        <div
                                            class="form-group {{$errors->has("reply-{$post->id}") ? 'has-error':''}}">
                                                <textarea name="reply-{{$post->id}}" class="form-control" rows="2"
                                                          placeholder="Comente sobre"></textarea>
                                            @if($errors->has("reply-{$post->id}"))
                                                <span class="help-block">
                                                        {{$errors->first("reply-{$post->id}")}}
                                                    </span>
                                            @endif
                                        </div>
                                        <input type="submit" value="Comentar" class="btn btn-default btn-sm">
                                        <input type="hidden" name="_token" value="{{Session::token()}}">
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        @endif
    </div>
    <br>
    {!!$status->render()!!}
    <br>
    <!-- LISTA DE AMIGOS PARA CHAT -->
@stop

{{--@if(Auth::user()->isFriendsWith($post->user) || Auth::user()->id===$post->user->id)--}}

