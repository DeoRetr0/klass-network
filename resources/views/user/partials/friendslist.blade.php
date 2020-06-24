<div class="media col" style="margin-bottom: 10px">
    <a href="{{route('profile.Perfil', ['username' =>$user->username])}}" class="pull-left">
        <img class="media-object" STYLE="width: 100px" src="{{URL::asset("uploads/avatars/{$user->avatar}")}}" alt="{{$user->getName()}}">
    </a>
    <div class="media-body">
        <h4 class="media-heading"><a href="{{route('profile.Perfil', ['username' =>$user->username])}}">{{$user->getName()}}</a></h4>
        @if($user->faculdade)
            <p>{{$user->faculdade}}<br>
                {{$user->curso}}</p>
        @endif
    </div>
</div>
