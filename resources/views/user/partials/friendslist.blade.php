<div class="media col" style="margin-bottom: 10px">
    <a href="{{route('profile.index', ['email' =>$user->email])}}" class="pull-left">
        <img class="media-object" src="{{$user->getAvatarUrl()}}" alt="{{$user->getName()}}">
    </a>
    <div class="media-body">
        <h4 class="media-heading"><a href="{{route('profile.index', ['email' =>$user->email])}}">{{$user->getName()}}</a></h4>
        @if($user->faculdade)
            <p>{{$user->faculdade}}<br>
                {{$user->curso}}</p>
        @endif
    </div>
</div>
