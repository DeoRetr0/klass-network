    <a href="{{route('profile.Perfil', ['username' =>$user->username])}}" class="pull-left">
        <img class="media-object"  style="margin-bottom: 7px; margin-left: -7px; padding: 2px; width: 63px" src="{{Storage::url("uploads/avatars/{$user->avatar}")}}" alt="{{$user->getName()}}">
    </a>

