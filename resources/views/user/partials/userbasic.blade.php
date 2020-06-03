    <a href="{{route('profile.index', ['email' =>$user->email])}}" class="pull-left">
        <img class="media-object"  style="margin-bottom: 7px; margin-left: -7px;" src="{{$user->getAvatarUrlBasic()}}" alt="{{$user->getName()}}">
    </a>
