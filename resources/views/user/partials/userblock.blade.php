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
        <img id="imgprincipal" class="media-object" src="{{asset('uploads/avatars/'.$user->avatar)}}" alt="{{$user->getName()}}">
    </a>
    <div style="margin-bottom: -10px; margin-top: -5px" class="media-body">
        <h4 class="media-heading"><a href="{{route('profile.Perfil', ['username' =>$user->username])}}">{{$user->getName()}}</a></h4>
        <h6 class="media-heading">{{'@'.$user->username}}</h6>
        @if($user->faculdade)
            <p>{{$user->faculdade}}<br>
                {{$user->curso}}</p>
        @endif
    </div>
</div>
