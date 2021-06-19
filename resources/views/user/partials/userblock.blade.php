<style>
    .media a {
        color: var(--primaryText-color);
    }
    h6{
        font-style: italic;
        color: darkgrey;
    }
    #imgprincipal{
        width: 150px;
        height: 150px;
    }
</style>
<div class="media" style="color: var(--primaryText-color); background-color: var(--bg-color); width: max-content; padding: 10px">
    <a href="{{route('profile.Perfil', ['username' =>$user->username])}}" class="pull-left">
        <img id="imgprincipal" class="media-object" src="{{asset('uploads/avatars/'.$user->getAvatar())}}" alt="{{$user->getName()}}">
    </a>
    <div style="margin-bottom: -10px; margin-top: -5px" class="media-body">
        <h4 class="media-heading"><a href="{{route('profile.Perfil', ['username' =>$user->username])}}">{{$user->getName()}}</a></h4>
        <h6 class="media-heading">{{'@'.$user->username}}</h6>
        @if($user->faculdade)
            <p>{{$user->faculdade}}<br>
                {{$user->curso}}</p>
        @endif
        @if ( Auth::user()->hasFriendRequestPending($user) )
        <p style="margin-top: -10px;">Aguardando {{ $user->getName() }} aceitar seu pedido</p>
        @elseif ( Auth::user()->hasFriendRequestReceived($user) )
        <a style="margin-top: -10px;" href="{{ route('friends.accept', ['username' => $user->username]) }}" class="btn btn-success">Aceitar
            seguidor</a>
        @elseif ( Auth::user()->isFriendsWith($user) )
        <form action="{{route('friends.delete', ['username' => $user->username])}}" method="post" style="margin-top: -5px">
            <input id="desAmigo" type="submit" class="btn btn-danger btn-sm" value="Deixar de Seguir">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        </form>
        @elseif ( Auth::user()->id !== $user->id)
        <a href="{{ route('friends.add', ['username' => $user->username]) }}" class="btn btn-success"
            style="margin-top: -10px; padding: -10px">
            Seguir
        </a>
        @endif
    </div>
</div>
